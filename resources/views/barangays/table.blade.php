<div class="table-responsive">
    <table class="table" id="barangays-table">
        <thead>
            <tr>
                <th>Townid</th>
        <th>Barangay</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($barangays as $barangays)
            <tr>
                <td>{{ $barangays->TownId }}</td>
            <td>{{ $barangays->Barangay }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['barangays.destroy', $barangays->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('barangays.show', [$barangays->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('barangays.edit', [$barangays->id]) }}" class='btn btn-default btn-xs'>
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
