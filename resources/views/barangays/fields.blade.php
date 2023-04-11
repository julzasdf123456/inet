<!-- Townid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TownId', 'Town:') !!}
    <select name="TownId" id="TownId" class="form-control">
        @foreach ($towns as $item)
            <option value="{{ $item->id }}">{{ $item->Town }}</option>
        @endforeach
    </select>
</div>

<!-- Barangay Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Barangay', 'Barangay:') !!}
    {!! Form::text('Barangay', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>