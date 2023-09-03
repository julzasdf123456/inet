<div class="table-responsive">
    <table class="table table-sm table-hover" id="stockHistories-table">
        <thead>
            <tr>
                <th>Stock</th>
                <th>Quantity</th>
                <th>User</th>
                <th>Datestocked</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($stockHistories as $stockHistory)
            <tr>
                <td>{{ $stockHistory->StockName }}</td>
                <td>{{ round($stockHistory->Quantity) }}</td>
                <td>{{ $stockHistory->name }}</td>
                <td>{{ $stockHistory->DateStocked }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['stockHistories.destroy', $stockHistory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('stockHistories.show', [$stockHistory->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('stockHistories.edit', [$stockHistory->id]) }}" class='btn btn-default btn-xs'>
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
