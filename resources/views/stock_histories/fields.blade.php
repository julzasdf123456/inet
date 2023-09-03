<!-- Stockid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('StockId', 'Stockid:') !!}
    {!! Form::text('StockId', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Quantity', 'Quantity:') !!}
    {!! Form::number('Quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Userid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('UserId', 'Userid:') !!}
    {!! Form::text('UserId', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Datestocked Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateStocked', 'Datestocked:') !!}
    {!! Form::text('DateStocked', null, ['class' => 'form-control','id'=>'DateStocked']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#DateStocked').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Notes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Notes', 'Notes:') !!}
    {!! Form::text('Notes', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>