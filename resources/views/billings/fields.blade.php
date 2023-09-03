<!-- Billamountdue Field -->
<div class="form-group col-sm-3">
    {!! Form::label('BillAmountDue', 'Bill Amount Due:') !!}
    {!! Form::number('BillAmountDue', null, ['class' => 'form-control']) !!}
</div>

<!-- Additionalpayments Field -->
<div class="form-group col-sm-3">
    {!! Form::label('AdditionalPayments', 'Additional Payments:') !!}
    {!! Form::number('AdditionalPayments', null, ['class' => 'form-control']) !!}
</div>

<!-- Deductions Field -->
<div class="form-group col-sm-3">
    {!! Form::label('Deductions', 'Deductions:') !!}
    {!! Form::number('Deductions', null, ['class' => 'form-control']) !!}
</div>

<!-- Totalamountdue Field -->
<div class="form-group col-sm-3">
    {!! Form::label('TotalAmountDue', 'Total Amount Due:') !!}
    {!! Form::number('TotalAmountDue', null, ['class' => 'form-control']) !!}
</div>

<!-- Billnumber Field -->
<div class="form-group col-sm-3">
    {!! Form::label('BillNumber', 'Bill Number:') !!}
    {!! Form::text('BillNumber', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Billingdate Field -->
<div class="form-group col-sm-3">
    {!! Form::label('BillingDate', 'Billing Date:') !!}
    {!! Form::text('BillingDate', null, ['class' => 'form-control','id'=>'BillingDate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#BillingDate').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Duedate Field -->
<div class="form-group col-sm-3">
    {!! Form::label('DueDate', 'Due Date:') !!}
    {!! Form::text('DueDate', null, ['class' => 'form-control','id'=>'DueDate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#DueDate').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Notes Field -->
<div class="form-group col-sm-3">
    {!! Form::label('Notes', 'Notes/Remarks:') !!}
    {!! Form::text('Notes', null, ['class' => 'form-control','maxlength' => 1500,'maxlength' => 1500]) !!}
</div>

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#BillAmountDue').on('keyup', function() {
                computeTotal()
            })

            $('#AdditionalPayments').on('keyup', function() {
                computeTotal()
            })

            $('#Deductions').on('keyup', function() {
                computeTotal()
            })
        })

        function computeTotal() {
            var billAmnt = jQuery.isEmptyObject($('#BillAmountDue').val()) ? 0 : parseFloat($('#BillAmountDue').val())
            var addons = jQuery.isEmptyObject($('#AdditionalPayments').val()) ? 0 : parseFloat($('#AdditionalPayments').val())
            var deductions = jQuery.isEmptyObject($('#Deductions').val()) ? 0 : parseFloat($('#Deductions').val())

            var total = billAmnt + addons - deductions
            $('#TotalAmountDue').val(total)
        }
    </script>
@endpush