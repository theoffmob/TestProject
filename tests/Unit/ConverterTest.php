<?php

namespace Tests\Unit;

use App\Enums\PrizeTypes;
use Illuminate\Http\Request;
use App\Http\Controllers\ConvertMoneyToPointsController;
use PHPUnit\Framework\TestCase;


/**
 * Class ConverterTest
 *
 * @package Tests\Unit
 */
class ConverterTest extends TestCase
{
    /**
     * @test
     */
    public function testConverter()
    {
        $checksum = new ConvertMoneyToPointsController;
        $result = $checksum
            ->convert(new Request([
                                     'type' => PrizeTypes::TYPE_MONEY,
                                     'money' => 456
                                  ]));
        $checkequal = (['type' => PrizeTypes::TYPE_BONUS, 'money' => '547']);
        $this->assertEquals($result, $checkequal);
    }
}