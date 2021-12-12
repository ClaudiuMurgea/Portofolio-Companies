<div>
    <input wire:model="video" class="dropzone" style="width: 50%" type="file" value="{{ old('logo') }}">
    {{-- <h4 class="text-center text-success mt-5"> Upload Video</h4> --}}
    <div>
        <button wire:click="storeVideo({{ $ids }})" class="btn btn-success mt-5"> Upload Video </button>
    </div>
</div>
