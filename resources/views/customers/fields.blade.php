<!-- Fullname Field -->
<div class="form-group col-sm-4">
    {!! Form::label('FullName', 'Full Name:') !!}
    {!! Form::text('FullName', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500, 'required' => true, 'autofocus' => true]) !!}
</div>

<!-- Contactnumber Field -->
<div class="form-group col-sm-4">
    {!! Form::label('ContactNumber', 'Contact Number:') !!}
    {!! Form::text('ContactNumber', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('Email', 'Email:') !!}
    {!! Form::email('Email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Town Field -->
<div class="form-group col-sm-4">
    {!! Form::label('Town', 'Town:') !!}
    <select name="Town" id="Town" class="form-control" required>
        @foreach ($towns as $item)
            <option value="{{ $item->id }}" {{ $customers != null && $customers->Town==$item->id ? 'selected' : '' }}>{{ $item->Town }}</option>
        @endforeach
    </select>
</div>

<!-- Barangay Field -->
<div class="form-group col-sm-4">
    {!! Form::label('Barangay', 'Barangay:') !!}
    {!! Form::select('Barangay', [], null, ['class' => 'form-control', 'required' => 'true']) !!}
</div>

<!-- Purok Field -->
<div class="form-group col-sm-4">
    {!! Form::label('Purok', 'Purok:') !!}
    {!! Form::text('Purok', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<p id="Def_Brgy" style="display: none;">{{ $cond=='new' ? '' : $customers->Barangay }}</p>
