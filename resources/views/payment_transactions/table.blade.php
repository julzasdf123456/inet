<div class="table-responsive">
    <table class="table" id="paymentTransactions-table">
        <thead>
            <tr>
                <th>Customerid</th>
        <th>Customername</th>
        <th>Paymentfor</th>
        <th>Billingmonth</th>
        <th>Ornumber</th>
        <th>Paymentdate</th>
        <th>Amountpaid</th>
        <th>Paymenttype</th>
        <th>Trash</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($paymentTransactions as $paymentTransactions)
            <tr>
                <td>{{ $paymentTransactions->CustomerId }}</td>
            <td>{{ $paymentTransactions->CustomerName }}</td>
            <td>{{ $paymentTransactions->PaymentFor }}</td>
            <td>{{ $paymentTransactions->BillingMonth }}</td>
            <td>{{ $paymentTransactions->ORNumber }}</td>
            <td>{{ $paymentTransactions->PaymentDate }}</td>
            <td>{{ $paymentTransactions->AmountPaid }}</td>
            <td>{{ $paymentTransactions->PaymentType }}</td>
            <td>{{ $paymentTransactions->Trash }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['paymentTransactions.destroy', $paymentTransactions->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('paymentTransactions.show', [$paymentTransactions->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('paymentTransactions.edit', [$paymentTransactions->id]) }}" class='btn btn-default btn-xs'>
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
