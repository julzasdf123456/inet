<div class="table-responsive">
    <table class="table" id="billings-table">
        <thead>
            <tr>
                <th>Billnumber</th>
        <th>Customerid</th>
        <th>Billingmonth</th>
        <th>Billingdate</th>
        <th>Duedate</th>
        <th>Billamountdue</th>
        <th>Additionalpayments</th>
        <th>Deductions</th>
        <th>Totalamountdue</th>
        <th>Paidamount</th>
        <th>Balance</th>
        <th>Notes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($billings as $billings)
            <tr>
                <td>{{ $billings->BillNumber }}</td>
            <td>{{ $billings->CustomerId }}</td>
            <td>{{ $billings->BillingMonth }}</td>
            <td>{{ $billings->BillingDate }}</td>
            <td>{{ $billings->DueDate }}</td>
            <td>{{ $billings->BillAmountDue }}</td>
            <td>{{ $billings->AdditionalPayments }}</td>
            <td>{{ $billings->Deductions }}</td>
            <td>{{ $billings->TotalAmountDue }}</td>
            <td>{{ $billings->PaidAmount }}</td>
            <td>{{ $billings->Balance }}</td>
            <td>{{ $billings->Notes }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['billings.destroy', $billings->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('billings.show', [$billings->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('billings.edit', [$billings->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
