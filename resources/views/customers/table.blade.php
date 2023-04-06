<div class="table-responsive">
    <table class="table" id="customers-table">
        <thead>
            <tr>
                <th>Fullname</th>
        <th>Town</th>
        <th>Barangay</th>
        <th>Purok</th>
        <th>Contactnumber</th>
        <th>Email</th>
        <th>Customertechnicalid</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($customers as $customers)
            <tr>
                <td>{{ $customers->FullName }}</td>
            <td>{{ $customers->Town }}</td>
            <td>{{ $customers->Barangay }}</td>
            <td>{{ $customers->Purok }}</td>
            <td>{{ $customers->ContactNumber }}</td>
            <td>{{ $customers->Email }}</td>
            <td>{{ $customers->CustomerTechnicalId }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['customers.destroy', $customers->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('customers.show', [$customers->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('customers.edit', [$customers->id]) }}" class='btn btn-default btn-xs'>
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
