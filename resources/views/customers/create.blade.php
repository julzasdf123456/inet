@php
    use App\Models\IDGenerator;
@endphp

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>Create New Customer</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'customers.store']) !!}

            <div class="card-body">

                <div class="row">
                    {{-- DETAILS --}}
                    @php
                        $custId = IDGenerator::generateID();
                    @endphp
                    <input type="hidden" name="id" value="{{ $custId }}">
                    @include('customers.fields')

                    <div class="divider"></div>

                    {{-- TECHNICALS --}}
                    
                    <!-- Speedsubscribed Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('SpeedSubscribed', 'Subscribed Speed:') !!}
                        <select name="SpeedSubscribed" id="SpeedSubscribed" class="form-control">
                            <option value="5">5 Mbps</option>
                            <option value="10">10 Mbps</option>
                            <option value="15">15 Mbps</option>
                            <option value="20">20 Mbps</option>
                            <option value="25">25 Mbps</option>
                            <option value="30">30 Mbps</option>
                            <option value="40">40 Mbps</option>
                            <option value="50">50 Mbps</option>
                            <option value="100">100 Mbps</option>
                        </select>
                    </div>

                    <!-- Monthlypayment Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('MonthlyPayment', 'Monthly Payment:') !!}
                        {!! Form::number('MonthlyPayment', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- DateConnected Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('DateConnected', 'Date Connected:') !!}
                        {!! Form::text('DateConnected', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500, 'required' => true]) !!}
                    </div>

                    @push('page_scripts')
                        <script type="text/javascript">
                            $('#DateConnected').datetimepicker({
                                format: 'YYYY-MM-DD',
                                useCurrent: true,
                                sideBySide: true
                            })
                        </script>
                    @endpush

                    <!-- Modembrand Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('ModemBrand', 'Modem Brand:') !!}
                        {!! Form::text('ModemBrand', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- Modemnumber Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('ModemNumber', 'Modem Number:') !!}
                        {!! Form::text('ModemNumber', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- Macaddress Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('MacAddress', 'MAC Address:') !!}
                        {!! Form::text('MacAddress', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <div class="divider"></div>

                    <!-- InstallationFee Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('InstallationFee', 'Installation Fee:') !!}
                        {!! Form::number('InstallationFee', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>

                    <!-- ORNumber Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('ORNumber', 'OR/Invoice Number:') !!}
                        {!! Form::text('ORNumber', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- PaymentDate Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('PaymentDate', 'Payment Date:') !!}
                        {!! Form::text('PaymentDate', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500, 'required' => true]) !!}
                    </div>

                    @push('page_scripts')
                        <script type="text/javascript">
                            $('#PaymentDate').datetimepicker({
                                format: 'YYYY-MM-DD',
                                useCurrent: true,
                                sideBySide: true
                            })
                        </script>
                    @endpush
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('customers.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
