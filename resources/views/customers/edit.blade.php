@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Customers</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($customers, ['route' => ['customers.update', $customers->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    <!-- Fullname Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('FullName', 'Full Name:') !!}
                        {!! Form::text('FullName', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500, 'required' => true, 'autofocus' => true]) !!}
                    </div>

                    <!-- Contactnumber Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('ContactNumber', 'Contact Number:') !!}
                        {!! Form::text('ContactNumber', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- Email Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('Email', 'Email:') !!}
                        {!! Form::email('Email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                    </div>

                    <!-- Town Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('Town', 'Town:') !!}
                        <select name="Town" id="Town" class="form-control" required>
                            @foreach ($towns as $item)
                                <option value="{{ $item->id }}" {{ $customers != null && $customers->Town==$item->id ? 'selected' : '' }}>{{ $item->Town }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Barangay Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('Barangay', 'Barangay:') !!}
                        {!! Form::select('Barangay', [], null, ['class' => 'form-control', 'required' => 'true']) !!}
                    </div>

                    <!-- Purok Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('Purok', 'Purok:') !!}
                        {!! Form::text('Purok', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
                    </div>

                    <!-- DateConnected Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('DateConnected', 'Date Connected:') !!}
                        {!! Form::text('DateConnected', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500, 'required' => true, 'autofocus' => true]) !!}
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

                    <!-- Status Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('Status', 'Status:') !!}
                        <select name="Status" id="Status" class="form-control">
                            <option value="ACTIVE" {{ $customers->Status=='ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                            <option value="DISCONNECTED" {{ $customers->Status=='DISCONNECTED' ? 'selected' : '' }}>DISCONNECTED</option>
                        </select>
                    </div>

                    <p id="Def_Brgy" style="display: none;">{{ $cond=='new' ? '' : $customers->Barangay }}</p>
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
