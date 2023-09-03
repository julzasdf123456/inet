<!-- Expensedate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ExpenseDate', 'Expensedate:') !!}
    {!! Form::text('ExpenseDate', null, ['class' => 'form-control','id'=>'ExpenseDate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#ExpenseDate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Expensefor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ExpenseFor', 'Expensefor:') !!}
    {!! Form::text('ExpenseFor', null, ['class' => 'form-control','maxlength' => 1500,'maxlength' => 1500]) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Amount', 'Amount:') !!}
    {!! Form::number('Amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Userid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('UserId', 'Userid:') !!}
    {!! Form::text('UserId', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>