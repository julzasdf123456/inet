<!-- Stockname Field -->
<div class="col-sm-12">
    {!! Form::label('StockName', 'Stockname:') !!}
    <p>{{ $stocks->StockName }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('Description', 'Description:') !!}
    <p>{{ $stocks->Description }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('Type', 'Type:') !!}
    <p>{{ $stocks->Type }}</p>
</div>

<!-- Canbechargedtocustomer Field -->
<div class="col-sm-12">
    {!! Form::label('CanBeChargedToCustomer', 'Canbechargedtocustomer:') !!}
    <p>{{ $stocks->CanBeChargedToCustomer }}</p>
</div>

<!-- Retailprice Field -->
<div class="col-sm-12">
    {!! Form::label('RetailPrice', 'Retailprice:') !!}
    <p>{{ $stocks->RetailPrice }}</p>
</div>

<!-- Unit Field -->
<div class="col-sm-12">
    {!! Form::label('Unit', 'Unit:') !!}
    <p>{{ $stocks->Unit }}</p>
</div>

<!-- Stockquantity Field -->
<div class="col-sm-12">
    {!! Form::label('StockQuantity', 'Stockquantity:') !!}
    <p>{{ $stocks->StockQuantity }}</p>
</div>

