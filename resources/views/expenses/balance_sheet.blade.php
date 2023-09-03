@php 
   use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
               <h4>Monthly Balance Sheet</h4>
               {!! Form::open(['route' => 'expenses.balance-sheet', 'method' => 'GET']) !!}
               <div class="row">
                  <div class="form-group col-md-4">
                     <label for="Month">Month</label>
                     <select name="Month" id="Month" class="form-control form-control-sm">
                           <option value="JANUARY" {{ isset($_GET['Month']) ? ($_GET['Month']=='JANUARY' ? 'selected' : '') : (strtoupper(date('F')) == 'JANUARY' ? 'selected' : '') }}>JANUARY</option>
                           <option value="FEBRUARY" {{ isset($_GET['Month']) ? ($_GET['Month']=='FEBRUARY' ? 'selected' : '') :  (strtoupper(date('F')) == 'FEBRUARY' ? 'selected' : '') }}>FEBRUARY</option>
                           <option value="MARCH" {{ isset($_GET['Month']) ? ($_GET['Month']=='MARCH' ? 'selected' : '') :  (strtoupper(date('F')) == 'MARCH' ? 'selected' : '') }}>MARCH</option>
                           <option value="APRIL" {{ isset($_GET['Month']) ? ($_GET['Month']=='APRIL' ? 'selected' : '') :  (strtoupper(date('F')) == 'APRIL' ? 'selected' : '') }}>APRIL</option>
                           <option value="MAY" {{ isset($_GET['Month']) ? ($_GET['Month']=='MAY' ? 'selected' : '') :  (strtoupper(date('F')) == 'MAY' ? 'selected' : '') }}>MAY</option>
                           <option value="JUNE" {{ isset($_GET['Month']) ? ($_GET['Month']=='JUNE' ? 'selected' : '') :  (strtoupper(date('F')) == 'JUNE' ? 'selected' : '') }}>JUNE</option>
                           <option value="JULY" {{ isset($_GET['Month']) ? ($_GET['Month']=='JULY' ? 'selected' : '') :  (strtoupper(date('F')) == 'JULY' ? 'selected' : '') }}>JULY</option>
                           <option value="AUGUST" {{ isset($_GET['Month']) ? ($_GET['Month']=='AUGUST' ? 'selected' : '') :  (strtoupper(date('F')) == 'AUGUST' ? 'selected' : '') }}>AUGUST</option>
                           <option value="SEPTEMBER" {{ isset($_GET['Month']) ? ($_GET['Month']=='SEPTEMBER' ? 'selected' : '') :  (strtoupper(date('F')) == 'SEPTEMBER' ? 'selected' : '') }}>SEPTEMBER</option>
                           <option value="OCTOBER" {{ isset($_GET['Month']) ? ($_GET['Month']=='OCTOBER' ? 'selected' : '') :  (strtoupper(date('F')) == 'OCTOBER' ? 'selected' : '') }}>OCTOBER</option>
                           <option value="NOVEMBER" {{ isset($_GET['Month']) ? ($_GET['Month']=='NOVEMBER' ? 'selected' : '') :  (strtoupper(date('F')) == 'NOVEMBER' ? 'selected' : '') }}>NOVEMBER</option>
                           <option value="DECEMBER" {{ isset($_GET['Month']) ? ($_GET['Month']=='DECEMBER' ? 'selected' : '') :  (strtoupper(date('F')) == 'DECEMBER' ? 'selected' : '') }}>DECEMBER</option>
                     </select>
                  </div>

                  <div class="form-group col-md-3">
                     <label for="Year">Year</label>
                     <input type="text" maxlength="4" id="Year" name="Year" placeholder="Year" value="{{ isset($_GET['Year']) ? $_GET['Year'] : date('Y') }}" class="form-control form-control-sm" required>
                  </div>

                  <div class="form-group col-md-3">
                     <label for="Action">Action</label><br>
                     <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-check ico-tab-mini"></i>View</button>
                     {{-- <button id="download" class="btn btn-sm btn-success"><i class="fas fa-download ico-tab-mini"></i>Download</button> --}}
                  </div>
               </div>
               {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

<div class="row">
   <div class="col-lg-12">
      <div class="card shadow-none">
         <div class="card-header p-2 border-0">
            <ul class="nav nav-pills">
               <li class="nav-item"><a class="nav-link active" href="#consolidated" data-toggle="tab">
                  <i class="fas fa-book"></i>
                  Consolidated Sheet</a></li>
               <li class="nav-item"><a class="nav-link" href="#detailed" data-toggle="tab">
                  <i class="fas fa-list"></i>
                  Detailed Sheet</a></li>
            </ul>
         </div>
         <div class="card-body px-0">
            <div class="tab-content">
               <div class="tab-pane active" id="consolidated">
                  @include('expenses.tab_bs_consolidated')
               </div>
               <div class="tab-pane" id="detailed">
                  @include('expenses.tab_bs_detailed')
               </div>
           </div>
         </div>
      </div>
   </div>
</div>

@endsection