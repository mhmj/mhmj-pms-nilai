@extends('layouts.dashboard.layout')

@section('content')
    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Staff' )
        <div class="page-wrapper">
            <div class="page-inner">
                @include('menu.menu')
                <div class="page-content-wrapper">
                    @include('menu.header')
                    <report-dashboard></report-dashboard>
                    @include('menu.color')
                    @include('menu.footer')
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->role == 'Customer' )
        <div class="page-wrapper">
            <div class="page-inner">
                @include('menu.menu')
                <div class="page-content-wrapper">
                    @include('menu.header')
                    <customer-list-shipment company_id="{{Auth::user()->company_id}}"></customer-list-shipment>
                    @include('menu.color')
                    @include('menu.footer')
                </div>
            </div>
        </div>
    @endif
@endsection
