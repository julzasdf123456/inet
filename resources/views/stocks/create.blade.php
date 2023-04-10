@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>Add New Stocks</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'stockHistories.store']) !!}

            <div class="card-body">

                <div class="row">
                    <!-- Stockname Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('StockName', 'Stockname:') !!}
                        {!! Form::text('StockName', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- Description Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('Description', 'Description:') !!}
                        {!! Form::text('Description', null, ['class' => 'form-control','maxlength' => 600,'maxlength' => 600]) !!}
                    </div>

                    <!-- Type Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('Type', 'Type:') !!}
                        {!! Form::text('Type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- Canbechargedtocustomer Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('CanBeChargedToCustomer', 'Canbechargedtocustomer:') !!}
                        {!! Form::text('CanBeChargedToCustomer', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- Retailprice Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('RetailPrice', 'Retailprice:') !!}
                        {!! Form::number('RetailPrice', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Unit Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('Unit', 'Unit:') !!}
                        {!! Form::text('Unit', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- Stockquantity Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('StockQuantity', 'Stockquantity:') !!}
                        {!! Form::text('StockQuantity', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('stocks.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
