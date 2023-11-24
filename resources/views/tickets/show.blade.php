@php
    use App\Models\Customers;
@endphp

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Tickets Details</h4>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('tickets.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        {{-- CUSTOMER INFO --}}
        <div class="col-lg-4">
            <div class="card shadow-none">
                <div class="card-header border-0">
                    <span class="card-title text-muted"><i class="fas fa-info-circle"> </i> Customer Info</span>
                    <div class="card-tools">
                        <a href="{{ route('customers.show', [$customer->id]) }}" class="btn btn-tool">View Customer Info</a>
                    </div>
                </div>
                <div class="card-body">
                    <p style="margin: 0px; padding: 0px;" title="Account Number">{{ $customer->id }} <span class="float-right badge {{ $customer->Status=='ACTIVE' ? 'bg-success' : 'bg-danger' }}">{{ $customer->Status }}</span></p>
                    <h4 title="Customer Name">{{ $customer->FullName }}</h4>
                    <p class="text-muted" style="margin: 0px; padding: 0px;" title="Customer Address">{{ Customers::getAddress($customer) }}</p>

                    <div class="divider"></div>

                    <table class="table table-borderless table-sm table-hover">
                        <tr>
                            <td class="text-muted">Contact Number</td>
                            <td class="text-right"><strong>{{ $customer->ContactNumber }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td class="text-right"><strong>{{ $customer->Email }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Date Connected</td>
                            <td class="text-right"><strong>{{ $customer->DateConnected != null ? date('M d, Y', strtotime($customer->DateConnected)) : '' }}</strong></td>
                        </tr> 
                        <tr>
                            <td class="text-muted">Monthly Payment</td>
                            <td class="text-right text-success"><strong>{{ $customerTechnical->MonthlyPayment != null ? 'P ' . number_format($customerTechnical->MonthlyPayment, 2) : '' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Speed Subscribed</td>
                            <td class="text-right text-primary"><strong>{{ $customerTechnical != null ? $customerTechnical->SpeedSubscribed . ' mbps' : '' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Modem Brand</td>
                            <td class="text-right text-primary">
                                <strong>{{ $customerTechnical != null ? $customerTechnical->ModemBrand : '' }}</strong>
                            </td> 
                        </tr>
                        <tr>
                            <td class="text-muted">Modem Serial No:</td>
                            <td class="text-right text-primary"><strong>{{ $customerTechnical != null ? $customerTechnical->ModemNumber : '' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">MAC Address</td>
                            <td class="text-right text-primary"><strong>{{ $customerTechnical != null ? $customerTechnical->MacAddress : '' }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>   
             
        {{-- TABS --}}
        <div class="col-lg-8 col-md-7">
            <div class="card shadow-none">
                <div class="card-header">
                    <span class="card-title"><i class="fas fa-exclamation-triangle ico-tab"></i>Ticket Status : <span class="badge bg-primary">{{ $ticket->Status }}</span></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- TICKET INFO --}}
                        <div class="col-lg-8 col-md-12">
                            <p class="text-muted">Ticket Details</p>
                            <table class="table table-hover">
                                <tr>
                                    <td class="text-muted">Ticket ID</td>
                                    <td><strong>{{ $ticket->id }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Ticket</td>
                                    <td><strong>{{ $ticket->TicketName }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Ticket Notes</td>
                                    <td><strong>{{ $ticket->Details }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Filed at</td>
                                    <td><strong>{{ date('M d, Y', strtotime($ticket->created_at)) }}</strong></td>
                                </tr>
                            </table>
                        </div>

                        {{-- LOGS --}}
                        <div class="col-lg-4 col-md-12">
                            <p class="text-muted">Ticket Logs</p>
                            <table class="table table-hover table-sm table-borderless">
                                @foreach ($ticketLogs as $item)
                                    <tr style="border-left: 1px solid #b9b8b8;">
                                        <td width="10"><i class="fas fa-check-circle text-muted"></i></td>
                                        <td class="text-muted">
                                            {{ $item->LogDetails }} <br>
                                            <span style="font-size: .6em;">{{ date('M d, Y h:i A', strtotime($item->created_at)) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
