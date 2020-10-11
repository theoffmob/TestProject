<?php

namespace App\Console\Commands;

use App\Enums\PayoutStatus;
use App\Enums\PrizeTypes;
use App\Model\UserWinning;
use Config;
use Illuminate\Console\Command;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payout;
use PayPal\Api\Currency;
use PayPal\Auth\OAuthTokenCredential;

/**
 * Class SendCashPrizeToUsers
 *
 * @package App\Console\Commands
 */
class SendCashPrizeToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendCash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Cash Prize To Users';

    /**
     * @var ApiContext
     */
    private $api_context;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        /** PayPal api context **/
        $paypal_conf = Config::get('paypal');
        $this->api_context = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            )
        );
        $this->api_context->setConfig($paypal_conf[ 'settings' ]);
    }

    /**
     *
     */
    public function handle()
    {
        $chunk = 100;
        $records = UserWinning::take($chunk)
                  ->where(
                      [
                            'payoutstatus' => PayoutStatus::PENDING,
                            'typeid' => PrizeTypes::TYPE_MONEY,
                        ]
                  )
                  ->with('User')
                  ->get();

        $payouts = new Payout();
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
                          ->setEmailSubject("You have a payment");

        if (count($records)) {
            foreach ($records as $key => $winning) {
                $senderItems[$key] = new PayoutItem();
                $senderItems[$key]->setRecipientType('Email')
                        ->setNote('Thanks you.')
                        ->setReceiver($winning['user']['email'])
                        ->setSenderItemId($key . uniqid())
                        ->setAmount(new Currency(
                            [
                                'value' => $winning['moneysum'],
                                'currency' => "RUB"
                            ]
                        ));
                $payouts->setSenderBatchHeader($senderBatchHeader)
                    ->addItem($senderItems[$key]);
            }
            $request = clone $payouts;
            try {
                $output = $payouts->create(null, $this->api_context);
                foreach ($records as $winning) {
                    $winning->payoutstatus = (PayoutStatus::FINISHED);
                    $winning->save();
                    $this->info("Send money to");
                    $this->info($winning[ 'user' ][ 'email' ]);
                    $this->info("|---------------------------------|");
                }
            } catch (\Exception $ex) {
                $this->error("Error ");
                $this->error($ex->getCode()); // Prints the Error Code
                $this->error($ex->getData()); // Prints the detailed error message
                die($ex);
            }
            $this->info("||-------------------------------||");
            $this->info("Created Batch Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);
            $this->info("sending is Ok");
            $this->info("all payouts is pending");
            $this->info("||-------------------------------||");
        } else {
            $this->error("=================");
            $this->error("nothing to Payout");
            $this->error("=================");
        }
    }
}
