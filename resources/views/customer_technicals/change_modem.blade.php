@php
    use App\Models\Customers;
    use App\Models\IDGenerator;
@endphp

@extends('layouts.app')

@section('content')
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h4>Change Modem</h4>
            </div>
         </div>
      </div>
   </section>

   <div class="row">
      {{-- INFO --}}
      <div class="col-lg-4">
         <div class="card shadow-none bg-info">
            <div class="card-header border-0">
               <span class="card-title"><i class="fas fa-info-circle"> </i> Customer Info</span>
            </div>
            <div class="card-body table-responsive p-0">
               <table class="table table-sm">
                  <tr>
                     <td>Name</td>
                     <td class="text-right">{{ $customer->FullName }}</td>
                  </tr>
                  <tr>
                     <td>Original Modem</td>
                     <td class="text-right">{{ $customerTechnical != null ? $customerTechnical->ModemBrand : '-' }}</td>
                  </tr>
                  <tr>
                     <td>Current Speed</td>
                     <td class="text-right">{{ $customerTechnical != null ? $customerTechnical->SpeedSubscribed . ' mbps' : '-' }}</td>
                  </tr>
                  <tr>
                     <td>Monthly Payment</td>
                     <td class="text-right">{{ $customerTechnical != null ? number_format($customerTechnical->MonthlyPayment, 2) : '-' }}</td>
                  </tr>
                  <tr>
                     <td>Original Modem No.</td>
                     <td class="text-right">{{ $customerTechnical != null ? $customerTechnical->ModemNumber : '-' }}</td>
                  </tr>
                  <tr>
                     <td>Original MAC Address</td>
                     <td class="text-right">{{ $customerTechnical != null ? $customerTechnical->MacAddress : '-' }}</td>
                  </tr>
               </table>
            </div>
         </div>
      </div>

      {{-- CHANGE --}}
      <div class="col-lg-8">
         <div class="card shadow-none">
            {!! Form::open(['route' => 'customerTechnicals.store']) !!}
            <div class="card-header">
               <span class="card-title">Update Modem and Subscription Info</span>
            </div>
            <div class="card-body">
               <div class="row">
                  <input type="hidden" name="CustomerId" value="{{ $customer->id }}">
                  <input type="hidden" name="id" value="{{ IDGenerator::generateID() }}">
                  <!-- Modembrand Field -->
                  <div class="form-group col-sm-4">
                     {!! Form::label('ModemBrand', 'Modem Brand:') !!}
                     {!! Form::text('ModemBrand', $customerTechnical != null ? $customerTechnical->ModemBrand : '', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'autofocus' => true]) !!}
                  </div>

                  <!-- Modemnumber Field -->
                  <div class="form-group col-sm-4">
                     {!! Form::label('ModemNumber', 'Modem Number:') !!}
                     {!! Form::text('ModemNumber', $customerTechnical != null ? $customerTechnical->ModemNumber : '', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                  </div>

                  <!-- Macaddress Field -->
                  <div class="form-group col-sm-4">
                     {!! Form::label('MacAddress', 'MAC Address:') !!}
                     {!! Form::text('MacAddress', $customerTechnical != null ? $customerTechnical->MacAddress : '', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                  </div>

                  <!-- Speedsubscribed Field -->
                  <div class="form-group col-sm-4">
                     {!! Form::label('SpeedSubscribed', 'Subscribed Speed:') !!}
                     <select name="SpeedSubscribed" id="SpeedSubscribed" class="form-control">
                           <option value="5" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='5' ? 'selected' : '' }}>5 Mbps</option>
                           <option value="10" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='10' ? 'selected' : '' }}>10 Mbps</option>
                           <option value="15" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='15' ? 'selected' : '' }}>15 Mbps</option>
                           <option value="20" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='20' ? 'selected' : '' }}>20 Mbps</option>
                           <option value="25" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='25' ? 'selected' : '' }}>25 Mbps</option>
                           <option value="30" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='30' ? 'selected' : '' }}>30 Mbps</option>
                           <option value="35" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='35' ? 'selected' : '' }}>35 Mbps</option>
                           <option value="40" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='40' ? 'selected' : '' }}>40 Mbps</option>
                           <option value="50" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='50' ? 'selected' : '' }}>50 Mbps</option>
                           <option value="100" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='100' ? 'selected' : '' }}>100 Mbps</option>
                           <option value="200" {{ $customerTechnical != null && $customerTechnical->SpeedSubscribed=='200' ? 'selected' : '' }}>200 Mbps</option>
                     </select>
                  </div>

                  <!-- Monthlypayment Field -->
                  <div class="form-group col-sm-4">
                     {!! Form::label('MonthlyPayment', 'Monthly Payment:') !!}
                     {!! Form::number('MonthlyPayment', $customerTechnical != null ? $customerTechnical->MonthlyPayment : 0, ['class' => 'form-control']) !!}
                  </div>

                  @push('page_scripts')
                     <script type="text/javascript">
                           $('#DateConnected').datetimepicker({
                              format: 'YYYY-MM-DD',
                              useCurrent: true,
                              sideBySide: true
                           })
                     </script>
                  @endpush
               </div>
            </div>
            <div class="card-footer">
               {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
         </div>
      </div>
   </div>
@endsection