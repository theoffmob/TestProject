<?php

use App\Enums\PrizeTypes;

?>
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @lang('prizing.addprizes')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form id="adding" class="add_prize" method="post" action="create">
            <div class="row">
                <div class="form-control col-sm-12">
                    <label for="type-money">Деньги</label>
                    <input type="radio" id="type-money" name="type" value="<?= PrizeTypes::TYPE_MONEY ?>" checked>
                </div>
                <div class="form-control col-sm-12">
                    <label for="type-bonus">Баллы</label>
                    <input type="radio" id="type-bonus" name="type" value="<?= PrizeTypes::TYPE_BONUS ?>">
                </div>
                <div class="form-control col-sm-12">
                    <label for="type-item">Предмет</label>
                    <input type="radio" id="type-item" name="type" value="<?= PrizeTypes::TYPE_ITEM ?>">
                </div>
                <div class="col-sm-12">
                    <label for="amount">Amount</label>
                    <input type='number' name='amount' id="amount" maxlength="6" />
                </div>
                <div class="col-sm-12">
                    <input type='submit' value="Add prize" class="pull-left" />
                </div>
            </div>
         </form>

     </div>

    <script>
        $(function (){
            $('#adding').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'create',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: $('#adding').serialize(),
                    success: function(data){
                        if(data && data.result) {
                            alert(data.message);
                        } else {
                            alert(data);
                        }
                    },
                    error: function(){
                        alert(data.message);
                    }
                });
            });
        });
    </script>

@endsection
