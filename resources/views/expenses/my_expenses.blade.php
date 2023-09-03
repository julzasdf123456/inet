@php 
   use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
               <h4>My Expenses</h4>
               {!! Form::open(['route' => 'expenses.my-expenses', 'method' => 'GET']) !!}
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

            <div class="col-sm-6">
               @if ($total != null)
                  <p class="text-muted text-right" style="margin: 0px; padding: 0px;">Total Expenses This Month</p>
                  <h1 class="text-danger text-right">₱ {{ number_format($total->Total, 2) }}</h1>
               @endif
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-none">
            <div class="card-header">
               <div class="card-tools">
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-expense"><i class="fas fa-plus-circle ico-tab-mini"></i>Add Expense</button>
               </div>
            </div>
            <div class="card-body table-responsive p-0">
               <table class="table table-hover table-sm table-bordered">
                  <thead>
                     <th>#</th>
                     <th>Expense Description</th>
                     <th>Expense Date</th>
                     <th>Amount</th>
                     <th style="width: 70px;"></th>
                  </thead>
                  <tbody>
                     @php
                         $i = 1;
                         $total = 0;
                     @endphp
                     @foreach ($data as $item)
                        <tr>
                           <td>{{ $i }}</td>
                           <td>{{ $item->ExpenseFor }}</td>
                           <td>{{ date('M d, Y', strtotime($item->ExpenseDate)) }}</td>
                           <td class="text-right text-danger">₱ {{ number_format($item->Amount, 2) }}</td>
                           <td class="text-right">
                              {!! Form::open(['route' => ['expenses.remove-my-expense', $item->id], 'method' => 'GET']) !!}
                                 {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn text-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                              {!! Form::close() !!}
                           </td>
                        </tr>
                        @php
                           $i++;
                           $total += floatval($item->Amount);
                        @endphp
                     @endforeach
                     <tr>
                        <td colspan="3"><strong>TOTAL EXPENSE</strong></td>
                        <td class="text-right text-danger"><strong>₱ {{ number_format($total, 2) }}</strong></td>
                        <td></td>
                     </tr>
                  </tbody>
               </table>
            </div>
        </div>
    </div>
</div>

{{-- ADD EXPENSE --}}
<div class="modal fade" id="modal-add-expense" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h4 class="modal-title">Add New Expense</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
               </button>
           </div>
           <div class="modal-body">
               <div class="form-group">
                  <label for="ExpenseFor">Expense Purpose</label>
                  <input type="text" name="ExpenseFor" id="ExpenseFor" value="" class="form-control">
               </div>

               <div class="form-group">
                  <label for="Amount">Expense Amount</label>
                  <input type="number" name="Amount" id="Amount" value="" class="form-control">
               </div>

               <div class="form-group">
                   <label for="ExpenseDate">Expense Date</label>
                   <input type="text" name="ExpenseDate" id="ExpenseDate" value="" class="form-control">
               </div>

               <div class="form-group">
                  <label>Charging</label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="Options" value="{{ Auth::id() }}" checked>
                      <label class="form-check-label">Charge to Me</label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="Options" value="">
                      <label class="form-check-label">Charge to Everyone</label>
                  </div>
              </div>

               @push('page_scripts')
                   <script type="text/javascript">
                       $('#ExpenseDate').datetimepicker({
                           format: 'YYYY-MM-DD',
                           useCurrent: false,
                           sideBySide: true
                       })
                   </script>
               @endpush
           </div>
           <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
               <button type="button" class="btn btn-sm btn-primary" id="add-expense"><i class="fas fa-plus ico-tab-mini"></i>Add Expense</button>
           </div>
       </div>
   </div>
</div>
@endsection

@push('page_scripts')
   <script>
      $(document).ready(function() {
         $('#add-expense').on('click', function() {
            var amount = $('#Amount').val()
            var expfor = $('#ExpenseFor').val()
            var date = $('#ExpenseDate').val()
            var user = $('input[name="Options"]:checked').val()
            
            if (jQuery.isEmptyObject(amount) | jQuery.isEmptyObject(expfor) | jQuery.isEmptyObject(date)) {
               Toast.fire({
                  icon : 'warning',
                  text : 'Please supply all data'
               })
            } else {
               $.ajax({
                  url : "{{ route('expenses.store-ajax') }}",
                  type : 'POST',
                  data : {
                     _token : "{{ csrf_token() }}",
                     ExpenseDate : date,
                     ExpenseFor : expfor,
                     Amount : amount,
                     UserId : user,
                  },
                  success : function(res) {
                     Toast.fire({
                        icon : 'success',
                        text : 'Expense added!'
                     })
                     location.reload()
                  },
                  error : function(err) {
                     Toast.fire({
                        icon : 'error',
                        text : 'Error adding expense!'
                     })
                  }
               })
            }
         })
      })
   </script>
@endpush