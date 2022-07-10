@extends('layouts/contentLayoutMaster')

@section('title', 'Rekapitulasi')

@section('content')
<livewire:rekapitulasi /> 
@endsection
@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script>
    var startDate,
        endDate,
    updateStartDate = function() {
        startPicker.setStartRange(startDate);
        endPicker.setStartRange(startDate);
        endPicker.setMinDate(startDate);
    },
    updateEndDate = function() {
        startPicker.setEndRange(endDate);
        startPicker.setMaxDate(endDate);
        endPicker.setEndRange(endDate);
    },
    startPicker = new Pikaday({
        field: document.getElementById('start'),
        format: 'DD-MM-YYYY',
        minDate: new Date(),
        maxDate: new Date(2020, 12, 31),
        onSelect: function() {
            startDate = this.getDate();
            console.log(startDate);
            updateStartDate();
            Livewire.emit('getStart', startDate)
        }
    }),
    endPicker = new Pikaday({
        field: document.getElementById('end'),
        format: 'DD-MM-YYYY',
        minDate: new Date(),
        maxDate: new Date(2020, 12, 31),
        onSelect: function() {
            endDate = this.getDate();
            updateEndDate();
            Livewire.emit('getEnd', endDate)
        }
    }),
    _startDate = startPicker.getDate(),
    _endDate = endPicker.getDate();
    if (_startDate) {
        startDate = _startDate;
        updateStartDate();
    }
    if (_endDate) {
        endDate = _endDate;
        updateEndDate();
    }
</script>
@endsection
@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endsection