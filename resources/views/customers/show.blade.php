@php
    use App\Models\Customers;
@endphp

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12" style="height: 10px;"></div>
        {{-- CUSTOMER INFO --}}
        <div class="col-lg-4">
            <div class="card shadow-none">
                <div class="card-header border-0">
                    <span class="card-title text-muted"><i class="fas fa-info-circle"> </i> Customer Info</span>
                    <div class="card-tools">
                        {!! Form::open(['route' => ['customers.destroy', $customer->id], 'method' => 'delete']) !!}
                            <a class="btn btn-xs text-primary" title="Edit Consumer Info" href="{{ route('customers.edit', [$customer->id]) }}"><i class="fas fa-pen"></i></a>
                            <a href="{{ route('customerTechnicals.change-modem', [$customer->id]) }}" class="btn btn-link btn-xs text-warning" title="Change Modem or Upgrade/Downgrade Subscribed Speed"><i class="fas fa-level-up-alt"></i></a>
                            {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs text-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
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
                        <tr>
                            <td class="text-muted">Encoder</td>
                            <td class="text-right">{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Date Encoded</td>
                            <td class="text-right">{{ $customer->created_at != null ? date('M d, Y', strtotime($customer->created_at)) : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>   
             
        {{-- TABS --}}
        <div class="col-lg-8 col-md-7">
            <div class="card shadow-none">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#billing" data-toggle="tab">
                            <i class="fas fa-file-invoice"></i>
                            Billing</a></li>
                        <li class="nav-item"><a class="nav-link" href="#transaction-history" data-toggle="tab">
                            <i class="fas fa-receipt"></i>
                            Transactions</a></li>
                        <li class="nav-item"><a class="nav-link" href="#modem-history" data-toggle="tab">
                            <i class="fas fa-history"></i>
                            Modem & Subscription</a></li>
                        <li class="nav-item"><a class="nav-link" href="#location" data-toggle="tab">
                            <i class="fas fa-map-marker-alt"></i>
                            Location</a></li>
                    </ul>
                </div>

                <div class="card-body px-0">
                    <div class="tab-content">
                        <div class="tab-pane active" id="billing">
                            @include('customers.tab_billing')
                        </div>

                        <div class="tab-pane" id="transaction-history">
                            @include('customers.tab_transaction_history')
                        </div>

                        <div class="tab-pane" id="modem-history">
                            @include('customers.tab_modem_history')
                        </div>

                        <div class="tab-pane" id="location">
                            @include('customers.tab_location')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
