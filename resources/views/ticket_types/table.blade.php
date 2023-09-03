<div class="table-responsive">
    <table class="table" id="ticketTypes-table">
        <thead>
            <tr>
                <th>Ticketname</th>
        <th>Notes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($ticketTypes as $ticketTypes)
            <tr>
                <td>{{ $ticketTypes->TicketName }}</td>
            <td>{{ $ticketTypes->Notes }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['ticketTypes.destroy', $ticketTypes->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('ticketTypes.show', [$ticketTypes->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('ticketTypes.edit', [$ticketTypes->id]) }}" class='btn btn-default btn-xs'>
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
