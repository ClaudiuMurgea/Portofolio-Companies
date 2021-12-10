<div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-center"> &emsp; Company Wide Banners &emsp;
                        <span class="d-flex justify-content-between">
                        <button wire:click="show('showVideo')" class="btn btn-primary btn-icon-text btn-edit-profile" >Add Video Banner</button>
                        <button wire:click="show('showImage')" class="btn btn-primary btn-icon-text btn-edit-profile" >Add Image Banner</button>
                        </span>

                        {{-- <form action="/banners/{{ $ids }}" class="dropzone" id="my-awesome"> --}}

                    <span class="d-flex justify-content-between">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    </span>

                        {{-- </form> --}}

                    @if($showVideo == true)
                        <input wire:model="video" class="dropzone" style="width: 50%" type="file" value="{{ old('logo') }}">
                        {{-- <h4 class="text-center text-success mt-5"> Upload Video</h4> --}}
                        <div>
                            <button wire:click="storeVideo({{ $ids }})" class="btn btn-success mt-5"> Upload Video </button>
                        </div>
                    @endif

                    @if($showImage == true)
                    
                        <input wire:model="image" class="dropzone" style="width: 50%" type="file" value="{{ old('logo') }}">
                        <button wire:click="store({{ $ids }})" class="btn btn-success mt-5"> Upload Photo </button>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
