<div>

    {{-- <form wire:submit.prevent="schedule">
        <label for="title">Event Title</label>
        <input wire:model="title" id="title" type="text">
     
        <label for="date">Event Date</label>
        <x-date-picker wire:model="date" id="date"/>
     
        <button>Schedule Event</button>
    </form>

    <input
    x-data
    x-ref="input"
    x-init="new Pikaday({ field: $refs.input })"
    type="text"
    {{ $attributes }}
> --}}
    
    {{-- x-data=""
    x-on:change="value = $event.target.value"
    x-init="
        new Pikaday({ field: $refs.input, 'format': 'MM/DD/YYYY', firstDay: 1, minDate: new Date(), });"
        class="sm:w-27rem sm:w-full">
    <div class="relative mt-2">
        <input
            x-ref="input"
            x-bind:value="value"
            type="text"
            class="w-full pl-4 pr-10 py-2 leading-none rounded-lg shadow-sm focus:outline-none border-gray-300 text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50" placeholder="Select date"
        />
     </div>

     <input
    x-data
    x-ref="input"
    x-init="new Pikaday({ field: $refs.input })"
    type="text"
    {{ $attributes }}
>

<div>
    <x-color-picker wire:model="color"/>
</div> --}}

</div>