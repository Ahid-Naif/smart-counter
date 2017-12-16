@extends('portal.components.layout')

@section('dashboard-active')
    active
@endsection

@section('main-content')
    <div class="container-fluid">
        @if(auth()->user()->applications_count)
            <applications></applications>
        @else
            <div class="text-center">
                <div class="spacer"></div>
                <img src="@image(portal/noApplication.svg)">
                <h3>No applications found!</h3>
                <a href="{{ route('portal.application.create') }}" class="btn btn-rose">Start new application</a>
            </div>
        @endif
    </div>
@endsection