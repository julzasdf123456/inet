
@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Sales/Collection Monthly Report</h4>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-none">
            {!! Form::open(['route' => 'paymentTransactions.monthly-sales', 'method' => 'GET']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="Month">Month</label>
                        <select name="Month" id="Month" class="form-control form-control-sm">
                            <option value="JANUARY"  {{ isset($_GET['Month']) && $_GET['Month']=='JANUARY' ? 'selected' : '' }}>JANUARY</option>
                            <option value="FEBRUARY"  {{ isset($_GET['Month']) && $_GET['Month']=='FEBRUARY' ? 'selected' : '' }}>FEBRUARY</option>
                            <option value="MARCH"  {{ isset($_GET['Month']) && $_GET['Month']=='MARCH' ? 'selected' : '' }}>MARCH</option>
                            <option value="APRIL"  {{ isset($_GET['Month']) && $_GET['Month']=='APRIL' ? 'selected' : '' }}>APRIL</option>
                            <option value="MAY"  {{ isset($_GET['Month']) && $_GET['Month']=='MAY' ? 'selected' : '' }}>MAY</option>
                            <option value="JUNE"  {{ isset($_GET['Month']) && $_GET['Month']=='JUNE' ? 'selected' : '' }}>JUNE</option>
                            <option value="JULY"  {{ isset($_GET['Month']) && $_GET['Month']=='JULY' ? 'selected' : '' }}>JULY</option>
                            <option value="AUGUST"  {{ isset($_GET['Month']) && $_GET['Month']=='AUGUST' ? 'selected' : '' }}>AUGUST</option>
                            <option value="SEPTEMBER"  {{ isset($_GET['Month']) && $_GET['Month']=='SEPTEMBER' ? 'selected' : '' }}>SEPTEMBER</option>
                            <option value="OCTOBER"  {{ isset($_GET['Month']) && $_GET['Month']=='OCTOBER' ? 'selected' : '' }}>OCTOBER</option>
                            <option value="NOVEMBER"  {{ isset($_GET['Month']) && $_GET['Month']=='NOVEMBER' ? 'selected' : '' }}>NOVEMBER</option>
                            <option value="DECEMBER"  {{ isset($_GET['Month']) && $_GET['Month']=='DECEMBER' ? 'selected' : '' }}>DECEMBER</option>
                        </select>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="Year">Year</label>
                        <input type="text" maxlength="4" id="Year" name="Year" placeholder="Year" value="{{ isset($_GET['Year']) ? $_GET['Year'] : date('Y') }}" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Action">Action</label><br>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-check ico-tab-mini"></i>View</button>
                        {{-- <button id="download" class="btn btn-sm btn-success"><i class="fas fa-download ico-tab-mini"></i>Download</button> --}}
                    </div>

                    <div class="col-lg-6">
                        @if ($total != null)
                           <p class="text-muted text-right" style="margin: 0px; padding: 0px;">Total Collection This Month</p>
                           <h1 class="text-success text-right">₱ {{ number_format($total->Total, 2) }}</h1>
                        @endif
                    </div>
                </div>
                
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    {{-- DETAILS --}}
    <div class="col-lg-12">
        <div class="card shadow-none" style="height: 75vh;">
            <div class="card-header p-2 border-0">
               <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#all-payment-details" data-toggle="tab">
                     <i class="fas fa-list"></i>
                     All Payment Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#per-cashier" data-toggle="tab">
                     <i class="fas fa-user"></i>
                     Consolidated Per Cashier</a></li>
                  <li class="nav-item"><a class="nav-link" href="#per-type" data-toggle="tab">
                     <i class="fas fa-code-branch"></i>
                     Consolidated Per Payment Type</a></li>
                <li class="nav-item"><a class="nav-link" href="#per-town" data-toggle="tab">
                    <i class="fas fa-map-marker-alt"></i>
                    Consolidated Per Town</a></li>
               </ul>
            </div>
            <div class="card-body px-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="all-payment-details">
                        @include('payment_transactions.tab_monthly_all_payment_details')
                    </div>
                    <div class="tab-pane" id="per-cashier">
                        @include('payment_transactions.tab_monthly_per_cashier')
                    </div>
                    <div class="tab-pane" id="per-type">
                        @include('payment_transactions.tab_monthly_per_type')
                    </div>
                    <div class="tab-pane" id="per-town">
                        @include('payment_transactions.tab_monthly_town')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#download').on('click', function(e) {
                e.preventDefault()
                window.location.href = "{{ url('/member_consumers/download-monthly-reports') }}" + "/" + $('#Town').val() + "/" + $('#Month').val() + "/" + $('#Year').val() + "/" + $('#Office').val()
            })
        })

    </script>
@endpush