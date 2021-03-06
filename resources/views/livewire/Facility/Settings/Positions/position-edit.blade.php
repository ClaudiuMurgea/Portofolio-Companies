<div>
    @if ($active == true)
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        
                        <nav class="navbar navbar-light p-0">
                            <div class="container-fluid">
                                <a class="navbar-brand text-success  p-0">Edit Position</a>
                                <a wire:click="back" class="navbar-brand btn btn-success text-white  p-0 col-md-1 d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                                    &nbsp;Back &nbsp;
                                </a>
                            </div>
                        </nav>

                        <div class="row mt-4">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="edit_title">Position title</label>
                                    <div wire:ignore>
                                        <input wire:model.defer="edit_title" class="form-control">
                                    </div>
                                    @error('edit_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="edit_url">Aply URL</label>
                                    <input wire:model.defer="edit_url" class="form-control">

                                    @error('edit_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="edit_description">Description</label>
                                    <div wire:ignore>
                                        <textarea wire:model.lazy="edit_description" class="form-control"  id="edit_description" cols="40" rows="5"></textarea>
                                    </div>
                                   
                                    @error('edit_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="date">Valid until</label>

                                    <div wire:ignore>
                                        <form wire:submit.prevent="edit({{ $positionID }})">
                                            <input wire:model.lazy="edit_date" class="form-control" type="text" id="edit_date">
                                        </form>
                                    </div>

                                    @error('edit_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group">
                                <label class="offset-1" for="image">Select a featured image</label>

                                <ul class="featured-images slick-initialized slick-slider offset-1">
                                    <div class="slick-list draggable">
                                        <div class="slick-track" style="opacity: 1; width: 30000px; transform: translate3d(0px, 0px, 0px);">
                                    
                                            <li class="slick-slide slick-current slick-active mx-3" data-slick-index="0" aria-hidden="false" tabindex="0">
                                                <img width="180px" src="{{ url('/assets/images/positions/1.jpeg') }}" alt="img">

                                                <input type="radio" wire:model.lazy="image" value="1.jpeg">
                                                <div class="overlay d-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                </div>
                                            </a>
                                            </li>

                                            <li class="slick-slide slick-active mx-3" data-slick-index="1" aria-hidden="false" tabindex="0">
                                                    <img width="180px" src="{{ url('/assets/images/positions/2.jpeg') }}" alt="img">
                                                    <input type="radio" wire:model.lazy="image" value="2.jpeg">
                                                    <div class="overlay d-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="slick-slide slick-active mx-3" data-slick-index="2" aria-hidden="false" tabindex="0">
                                                    <img width="180px" src="{{ url('/assets/images/positions/3.jpeg') }}" alt="img">
                                                    <input type="radio" wire:model.lazy="image" value="3.jpeg">
                                                    <div class="overlay d-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="slick-slide slick-active mx-3" data-slick-index="5" aria-hidden="false" tabindex="0">
                                                    <img width="180px" src="{{ url('/assets/images/positions/6.jpg') }}" alt="img">
                                                    <input type="radio" wire:model.lazy="image" value="6.jpg">
                                                    <div class="overlay d-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    </div>
                                                </a>
                                            </li>
                                            
                                            <li class="slick-slide slick-active mx-3" data-slick-index="3" aria-hidden="false" tabindex="0">
                                                    <img width="180px" src="{{ url('/assets/images/positions/4.jpeg') }}" alt="img">
                                                    <input type="radio" wire:model.lazy="image" value="4.jpeg">
                                                    <div class="overlay d-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="slick-slide slick-active mx-3" data-slick-index="4" aria-hidden="false" tabindex="0">
                                                    <img width="180px" src="{{ url('/assets/images/positions/5.jpg') }}" alt="img">
                                                    <input type="radio" wire:model.lazy="image" value="5.jpg">
                                                    <div class="overlay d-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    </div>
                                                </a>
                                            </li>
                                        </div>
                                    </div>

                                </ul>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">                       
                            <div class="d-flex justify-content-center">
                                <div class="col-2">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <button wire:click="edit({{ $positionID }})" class="form-control mt-2 btn btn-success" type="submit">Edit Position</button>
                                </div>
                            </div>
                        </div>

                        <div class="position-absolute bottom-40 end-50">
                            <i wire:loading wire:target='edit' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($return == true)
        <div>
            <livewire:facility.settings.positions.positions-index :facility="$facilityID" />      
        </div>
@endif
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>

<script>
    new Pikaday({ field: document.getElementById('edit_date') })
    
        picker = new Pikaday({
        field: document.getElementById('edit_date'),
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

<script>
    ClassicEditor
      .create(document.querySelector('#edit_description'))
      .then(editor => {
          editor.model.document.on('change:data', () => {
          @this.set('edit_description', editor.getData());
         })
      })
      .catch(error => {
         console.error(error);
      });
</script>

<script>
    $(document).ready(function(){
  $('.slick-track').slick({
    setting-name: setting-value
  });
});
</script>

{{-- <script>
    new Pikaday({ field: document.getElementById('date') })
    
        picker = new Pikaday({
        field: document.getElementById('date'),
        firstDay: 0,
        setDefaultDate: true,
        minDate: new Date(2021, 11, 14),
        maxDate: new Date(2030, 12, 14),
        yearRange: [2021,2030],
    
        disableDayFn: function(theDate) {
           return false;
        }
    });
</script> --}}

