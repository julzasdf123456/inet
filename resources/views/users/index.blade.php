@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="card card-primary">
            <div class="card-header">
                <span class="card-title">Quick Stats</span>
            </div>

            <div class="card-body">
                <p>Active Users: <strong>{{ count($active) }}</strong></p>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-header">
                <span class="card-title">All Users ({{ count($users) }})</span>
            </div>

            <div class="card-body p-0">
                @include('users.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

