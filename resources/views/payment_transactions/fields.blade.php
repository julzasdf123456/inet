<!-- Customerid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CustomerId', 'Customerid:') !!}
    {!! Form::text('CustomerId', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Customername Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CustomerName', 'Customername:') !!}
    {!! Form::text('CustomerName', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<!-- Paymentfor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PaymentFor', 'Paymentfor:') !!}
    {!! Form::text('PaymentFor', null, ['class' => 'form-control','maxlength' => 1500,'maxlength' => 1500]) !!}
</div>

<!-- Billingmonth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillingMonth', 'Billingmonth:') !!}
    {!! Form::text('BillingMonth', null, ['class' => 'form-control','id'=>'BillingMonth']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#BillingMonth').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Ornumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ORNumber', 'Ornumber:') !!}
    {!! Form::text('ORNumber', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Paymentdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PaymentDate', 'Paymentdate:') !!}
    {!! Form::text('PaymentDate', null, ['class' => 'form-control','id'=>'PaymentDate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#PaymentDate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Amountpaid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AmountPaid', 'Amountpaid:') !!}
    {!! Form::number('AmountPaid', null, ['class' => 'form-control']) !!}
</div>

<!-- Paymenttype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PaymentType', 'Paymenttype:') !!}
    {!! Form::text('PaymentType', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Trash Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Trash', 'Trash:') !!}
    {!! Form::text('Trash', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>