<div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <h6 class="mb-5">Menus</h6>

                        <div wire:ignore>
                        {{-- <textarea name="description" id="description" cols="30" rows="10"></textarea> --}}
                    </div>
                        <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            &nbsp;Add Menu&emsp;
                        </a>
                    </div>

                    <div class="row form-group col-2">

                        <select wire:model="scheduleType"  class="form-control text-center text-success">
                            <option value="">Select Schedule Type</option>
                            @foreach ($scheduleTypes as $scheduleType)
                                <option value="{{ $scheduleType->name }}">{{ $scheduleType->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    @if ($Weekly == true)
                        <div class="row form-group col-2">
                            <livewire:facility.settings.test/> 
                        </div>
                    @endif

                    @if ($Bi_weekly == true)
                        bi-weekly
                    @endif

                    @if ($Tri_weekly == true)
                        tri_weekly
                    @endif

                    @if ($Monthly == true)
                        monthly
                    @endif
                    {{-- <form wire:submit.prevent="schedule"> --}}
                
                    {{-- <button>Schedule Event</button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
      .create(document.querySelector('#description'))
      .then(editor => {
          editor.model.document.on('change:data', () => {
          @this.set('description', editor.getData());
         })
      })
      .catch(error => {
         console.error(error);
      });
</script> --}}

<script>
    $('.your-element').on('swipe', function(event, slick, direction){
  console.log(direction);
  // left
});

</script>
