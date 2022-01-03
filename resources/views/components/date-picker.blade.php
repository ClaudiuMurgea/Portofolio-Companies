<div>

    <form wire:submit.prevent="schedule">
        <label for="title">Event Title</label>
        <input wire:model="title" id="title" type="text">
     
        <label for="date">Event Date</label>
        <x-date-picker wire:model="date" id="date"/>
     
        <button>Schedule Event</button>
    </form>

</div>