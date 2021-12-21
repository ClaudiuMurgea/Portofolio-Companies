<div wire:ignore>
    <input wire:model.lazy="datepicker" class="form-control" type="text" id="datepicker">
</div>
<script>
new Pikaday({ field: document.getElementById('datepicker') })

    picker = new Pikaday({
    field: document.getElementById('datepicker'),
    firstDay: 0,
    // pickWholeWeek: true,
    setDefaultDate: true,
    minDate: new Date(2021, 11, 14),
    maxDate: new Date(2030, 12, 14),
    yearRange: [2021,2030],

    disableDayFn: function(theDate) {
       return false;
    }
});
</script>