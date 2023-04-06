<!-- Billnumber Field -->
<div class="col-sm-12">
    {!! Form::label('BillNumber', 'Billnumber:') !!}
    <p>{{ $billings->BillNumber }}</p>
</div>

<!-- Customerid Field -->
<div class="col-sm-12">
    {!! Form::label('CustomerId', 'Customerid:') !!}
    <p>{{ $billings->CustomerId }}</p>
</div>

<!-- Billingmonth Field -->
<div class="col-sm-12">
    {!! Form::label('BillingMonth', 'Billingmonth:') !!}
    <p>{{ $billings->BillingMonth }}</p>
</div>

<!-- Billingdate Field -->
<div class="col-sm-12">
    {!! Form::label('BillingDate', 'Billingdate:') !!}
    <p>{{ $billings->BillingDate }}</p>
</div>

<!-- Duedate Field -->
<div class="col-sm-12">
    {!! Form::label('DueDate', 'Duedate:') !!}
    <p>{{ $billings->DueDate }}</p>
</div>

<!-- Billamountdue Field -->
<div class="col-sm-12">
    {!! Form::label('BillAmountDue', 'Billamountdue:') !!}
    <p>{{ $billings->BillAmountDue }}</p>
</div>

<!-- Additionalpayments Field -->
<div class="col-sm-12">
    {!! Form::label('AdditionalPayments', 'Additionalpayments:') !!}
    <p>{{ $billings->AdditionalPayments }}</p>
</div>

<!-- Deductions Field -->
<div class="col-sm-12">
    {!! Form::label('Deductions', 'Deductions:') !!}
    <p>{{ $billings->Deductions }}</p>
</div>

<!-- Totalamountdue Field -->
<div class="col-sm-12">
    {!! Form::label('TotalAmountDue', 'Totalamountdue:') !!}
    <p>{{ $billings->TotalAmountDue }}</p>
</div>

<!-- Paidamount Field -->
<div class="col-sm-12">
    {!! Form::label('PaidAmount', 'Paidamount:') !!}
    <p>{{ $billings->PaidAmount }}</p>
</div>

<!-- Balance Field -->
<div class="col-sm-12">
    {!! Form::label('Balance', 'Balance:') !!}
    <p>{{ $billings->Balance }}</p>
</div>

<!-- Notes Field -->
<div class="col-sm-12">
    {!! Form::label('Notes', 'Notes:') !!}
    <p>{{ $billings->Notes }}</p>
</div>

