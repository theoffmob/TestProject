@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('/js/WinPrizeScript.js') }}"></script>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('prizing.forwin')</div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id='msg'>
                            @lang('prizing.clictokwin')
                        </div>
                        <input type='submit' value="PUSH" onclick='getPrize()'>
                        <div style="padding-top: 10px;">
                            <input id="converting" style="display: none" type='submit' value="Convert" onclick='ConvertPrize(wincash)'>
                        </div>
                        <div id='conv' style="display: none">
                        </div>
                        <div id='depositmess' style="display: none; padding-top: 15px">
                            @lang('prizing.depositwin')
                        </div>
                        <div style="padding-top: 5px;">
                            <input id="write" style="display: none" type='submit' value="Deposit" onclick='WritePrize(wincash)'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
