<!-- Ticketid Field -->
<div class="col-sm-12">
    {!! Form::label('TicketId', 'Ticketid:') !!}
    <p>{{ $ticketLogs->TicketId }}</p>
</div>

<!-- Userid Field -->
<div class="col-sm-12">
    {!! Form::label('UserId', 'Userid:') !!}
    <p>{{ $ticketLogs->UserId }}</p>
</div>

<!-- Logdetails Field -->
<div class="col-sm-12">
    {!! Form::label('LogDetails', 'Logdetails:') !!}
    <p>{{ $ticketLogs->LogDetails }}</p>
</div>

<!-- Notes Field -->
<div class="col-sm-12">
    {!! Form::label('Notes', 'Notes:') !!}
    <p>{{ $ticketLogs->Notes }}</p>
</div>

