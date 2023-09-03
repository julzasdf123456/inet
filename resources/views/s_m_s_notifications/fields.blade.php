<!-- Contactnumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ContactNumber', 'Contactnumber:') !!}
    {!! Form::text('ContactNumber', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Message', 'Message:') !!}
    {!! Form::text('Message', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<!-- Customerid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CustomerId', 'Customerid:') !!}
    {!! Form::text('CustomerId', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Billing Month Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Billing Month', 'Billing Month:') !!}
    {!! Form::text('Billing Month', null, ['class' => 'form-control','id'=>'Billing Month']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#Billing Month').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Type', 'Type:') !!}
    {!! Form::text('Type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Status', 'Status:') !!}
    {!! Form::text('Status', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>