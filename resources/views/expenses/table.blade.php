<div class="table-responsive">
    <table class="table" id="expenses-table">
        <thead>
            <tr>
                <th>Expensedate</th>
        <th>Expensefor</th>
        <th>Amount</th>
        <th>Userid</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($expenses as $expenses)
            <tr>
                <td>{{ $expenses->ExpenseDate }}</td>
            <td>{{ $expenses->ExpenseFor }}</td>
            <td>{{ $expenses->Amount }}</td>
            <td>{{ $expenses->UserId }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['expenses.destroy', $expenses->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('expenses.show', [$expenses->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('expenses.edit', [$expenses->id]) }}" class='btn btn-default btn-xs'>
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
