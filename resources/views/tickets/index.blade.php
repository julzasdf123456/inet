@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Tickets</h4>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('tickets.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="row">
            {{-- NEW TICKETS --}}
            <div class="col-lg-12">
                <div class="card shadow-none" style="max-height: 60vh;">
                    <div class="card-header">
                        <span class="card-title"><i class="fas fa-exclamation-triangle ico-tab"></i>New Filed Tickets</span>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <th>Ticket ID</th>
                                <th>Customer</th>
                                <th>Ticket</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Filed At</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($newTickets as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <strong>{{ $item->CustomerName }}</strong><br>
                                            <span class="text-muted">{{ $item->BarangayName . ', ' . $item->TownName }}</span>
                                        </td>
                                        <td><strong>{{ $item->TicketName }}</strong></td>
                                        <td>{{ $item->Details }}</td>
                                        <td>{{ $item->Status }}</td>
                                        <td>{{ date('M d, Y h:i A', strtotime($item->created_at)) }}</td>
                                        <td width="120" class="text-right">
                                            {!! Form::open(['route' => ['tickets.destroy', $item->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{{ route('tickets.show', [$item->id]) }}" class='btn btn-default btn-xs'>
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tickets.edit', [$item->id]) }}" class='btn btn-default btn-xs'>
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
                </div>
            </div>

            {{-- ALL TICKETS --}}
            <div class="col-lg-12">
                <div class="card shadow-none">
                    <div class="card-header">
                        <span class="card-title"><i class="fas fa-list ico-tab"></i>All Filed Tickets</span>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm table-hover">
                            <thead>
                                <th>Ticket ID</th>
                                <th>Customer</th>
                                <th>Ticket</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Filed At</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($allTickets as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <strong>{{ $item->CustomerName }}</strong><br>
                                            <span class="text-muted">{{ $item->BarangayName . ', ' . $item->TownName }}</span>
                                        </td>
                                        <td><strong>{{ $item->TicketName }}</strong></td>
                                        <td>{{ $item->Details }}</td>
                                        <td>{{ $item->Status }}</td>
                                        <td>{{ date('M d, Y h:i A', strtotime($item->created_at)) }}</td>
                                        <td width="120" class="text-right">
                                            {!! Form::open(['route' => ['tickets.destroy', $item->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{{ route('tickets.show', [$item->id]) }}" class='btn btn-default btn-xs'>
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tickets.edit', [$item->id]) }}" class='btn btn-default btn-xs'>
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
                    <div class="card-footer">
                        {{ $allTickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

