<div class="table-responsive">
    <table class="table" id="sMSNotifications-table">
        <thead>
            <tr>
                <th>Contactnumber</th>
        <th>Message</th>
        <th>Customerid</th>
        <th>Billing Month</th>
        <th>Type</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sMSNotifications as $sMSNotifications)
            <tr>
                <td>{{ $sMSNotifications->ContactNumber }}</td>
            <td>{{ $sMSNotifications->Message }}</td>
            <td>{{ $sMSNotifications->CustomerId }}</td>
            <td>{{ $sMSNotifications->Billing Month }}</td>
            <td>{{ $sMSNotifications->Type }}</td>
            <td>{{ $sMSNotifications->Status }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['sMSNotifications.destroy', $sMSNotifications->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('sMSNotifications.show', [$sMSNotifications->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('sMSNotifications.edit', [$sMSNotifications->id]) }}" class='btn btn-default btn-xs'>
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
