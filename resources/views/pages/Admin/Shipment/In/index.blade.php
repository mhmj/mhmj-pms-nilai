@extends('layouts.dashboard.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-inner">
            @include('menu.menu')
            <div class="page-content-wrapper">
                @include('menu.header')
                <list-shipment-in></list-shipment-in>
                @include('menu.color')
                @include('menu.footer')
            </div>
        </div>
    </div>

@endsection
