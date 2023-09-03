@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Double Entry Customers</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card shadow-none">

            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <th>Customer Name</th>
                        <th>Town</th>
                        <th>Barangay</th>
                        <th>Number of Duplicates</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->FullName }}</td>
                                <td>{{ $item->Town }}</td>
                                <td>{{ $item->Barangay }}</td>
                                <td>{{ $item->Count }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm float-right" href="{{ route('customers.double-entry-view', [$item->FullName, $item->TownId, $item->BarangayId]) }}"><i class="fas fa-eye ico-tab-mini"></i>View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
