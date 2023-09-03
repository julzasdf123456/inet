<!-- Expensedate Field -->
<div class="col-sm-12">
    {!! Form::label('ExpenseDate', 'Expensedate:') !!}
    <p>{{ $expenses->ExpenseDate }}</p>
</div>

<!-- Expensefor Field -->
<div class="col-sm-12">
    {!! Form::label('ExpenseFor', 'Expensefor:') !!}
    <p>{{ $expenses->ExpenseFor }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('Amount', 'Amount:') !!}
    <p>{{ $expenses->Amount }}</p>
</div>

<!-- Userid Field -->
<div class="col-sm-12">
    {!! Form::label('UserId', 'Userid:') !!}
    <p>{{ $expenses->UserId }}</p>
</div>

