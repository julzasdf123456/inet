@php
    use App\Models\Customers;
@endphp

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Double Entry Assessment</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        @foreach ($customers as $item)
            <div class="col-lg-4">
                <div class="card shadow-none">
                    <div class="card-body">
                        <h4>{{ $item->FullName }}</h4>
                        <span class="text-muted">{{ Customers::getAddress($item) }}</span>

                        <div class="divider"></div>

                        <a href="" class="btn btn-xs btn-primary float-right"><i class="fas fa-eye ico-tab-mini"></i>View Account</a>

                        {!! Form::open(['route' => ['customers.destroy', $item->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="fas fa-trash"></i> Delete Account', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection