<!-- Stockid Field -->
<div class="col-sm-12">
    {!! Form::label('StockId', 'Stockid:') !!}
    <p>{{ $stockHistory->StockId }}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('Quantity', 'Quantity:') !!}
    <p>{{ $stockHistory->Quantity }}</p>
</div>

<!-- Userid Field -->
<div class="col-sm-12">
    {!! Form::label('UserId', 'Userid:') !!}
    <p>{{ $stockHistory->UserId }}</p>
</div>

<!-- Datestocked Field -->
<div class="col-sm-12">
    {!! Form::label('DateStocked', 'Datestocked:') !!}
    <p>{{ $stockHistory->DateStocked }}</p>
</div>

<!-- Notes Field -->
<div class="col-sm-12">
    {!! Form::label('Notes', 'Notes:') !!}
    <p>{{ $stockHistory->Notes }}</p>
</div>

