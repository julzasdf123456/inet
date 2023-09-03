<div class="table-responsive">
    <table class="table" id="customerTechnicals-table">
        <thead>
            <tr>
                <th>Customerid</th>
        <th>Speedsubscribed</th>
        <th>Monthlypayment</th>
        <th>Macaddress</th>
        <th>Modemid</th>
        <th>Modembrand</th>
        <th>Modemnumber</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($customerTechnicals as $customerTechnical)
            <tr>
                <td>{{ $customerTechnical->CustomerId }}</td>
            <td>{{ $customerTechnical->SpeedSubscribed }}</td>
            <td>{{ $customerTechnical->MonthlyPayment }}</td>
            <td>{{ $customerTechnical->MacAddress }}</td>
            <td>{{ $customerTechnical->ModemId }}</td>
            <td>{{ $customerTechnical->ModemBrand }}</td>
            <td>{{ $customerTechnical->ModemNumber }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['customerTechnicals.destroy', $customerTechnical->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('customerTechnicals.show', [$customerTechnical->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('customerTechnicals.edit', [$customerTechnical->id]) }}" class='btn btn-default btn-xs'>
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
