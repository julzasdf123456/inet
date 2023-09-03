<div class="table-responsive">
    <table class="table" id="tickets-table">
        <thead>
            <tr>
                <th>Customerid</th>
        <th>Customername</th>
        <th>Town</th>
        <th>Barangay</th>
        <th>Ticket</th>
        <th>Details</th>
        <th>Notes</th>
        <th>Status</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Executedby</th>
        <th>Userid</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tickets as $tickets)
            <tr>
                <td>{{ $tickets->CustomerId }}</td>
            <td>{{ $tickets->CustomerName }}</td>
            <td>{{ $tickets->Town }}</td>
            <td>{{ $tickets->Barangay }}</td>
            <td>{{ $tickets->Ticket }}</td>
            <td>{{ $tickets->Details }}</td>
            <td>{{ $tickets->Notes }}</td>
            <td>{{ $tickets->Status }}</td>
            <td>{{ $tickets->Latitude }}</td>
            <td>{{ $tickets->Longitude }}</td>
            <td>{{ $tickets->ExecutedBy }}</td>
            <td>{{ $tickets->UserId }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tickets.destroy', $tickets->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tickets.show', [$tickets->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tickets.edit', [$tickets->id]) }}" class='btn btn-default btn-xs'>
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
