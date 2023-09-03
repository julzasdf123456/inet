<!-- Customerid Field -->
<div class="col-sm-12">
    {!! Form::label('CustomerId', 'Customerid:') !!}
    <p>{{ $paymentTransactions->CustomerId }}</p>
</div>

<!-- Customername Field -->
<div class="col-sm-12">
    {!! Form::label('CustomerName', 'Customername:') !!}
    <p>{{ $paymentTransactions->CustomerName }}</p>
</div>

<!-- Paymentfor Field -->
<div class="col-sm-12">
    {!! Form::label('PaymentFor', 'Paymentfor:') !!}
    <p>{{ $paymentTransactions->PaymentFor }}</p>
</div>

<!-- Billingmonth Field -->
<div class="col-sm-12">
    {!! Form::label('BillingMonth', 'Billingmonth:') !!}
    <p>{{ $paymentTransactions->BillingMonth }}</p>
</div>

<!-- Ornumber Field -->
<div class="col-sm-12">
    {!! Form::label('ORNumber', 'Ornumber:') !!}
    <p>{{ $paymentTransactions->ORNumber }}</p>
</div>

<!-- Paymentdate Field -->
<div class="col-sm-12">
    {!! Form::label('PaymentDate', 'Paymentdate:') !!}
    <p>{{ $paymentTransactions->PaymentDate }}</p>
</div>

<!-- Amountpaid Field -->
<div class="col-sm-12">
    {!! Form::label('AmountPaid', 'Amountpaid:') !!}
    <p>{{ $paymentTransactions->AmountPaid }}</p>
</div>

<!-- Paymenttype Field -->
<div class="col-sm-12">
    {!! Form::label('PaymentType', 'Paymenttype:') !!}
    <p>{{ $paymentTransactions->PaymentType }}</p>
</div>

<!-- Trash Field -->
<div class="col-sm-12">
    {!! Form::label('Trash', 'Trash:') !!}
    <p>{{ $paymentTransactions->Trash }}</p>
</div>

