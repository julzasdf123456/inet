<div class="table-responsive">
    <table class="table table-sm table-hover" id="stocks-table">
        <thead>
            <tr>
                <th>Stock Name</th>
                <th>Description</th>
                <th>Type</th>
                <th>Can be Sold</th>
                <th>Retail Price</th>
                <th>Quantity In Stock</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stocks)
            <tr>
                <td>{{ $stocks->StockName }}</td>
                <td>{{ $stocks->Description }}</td>
                <td>{{ $stocks->Type }}</td>
                <td>{{ $stocks->CanBeChargedToCustomer }}</td>
                <td>{{ $stocks->RetailPrice }}</td>
                <td>{{ $stocks->StockQuantity != null ? $stocks->StockQuantity : '0' }} {{ $stocks->Unit }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['stocks.destroy', $stocks->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('stocks.show', [$stocks->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('stocks.edit', [$stocks->id]) }}" class='btn btn-default btn-xs'>
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
