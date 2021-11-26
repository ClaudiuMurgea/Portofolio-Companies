<figure class="position-absolute top-0 start-0" style="width:1650px;">
    <img class="img-fluid" style="max-width: 100%;max-height: 100%;" src="{{ url('/defaults/default-banner.jpg') }}" class="img-fluid" alt="profile cover">
</figure>
@push('plugin-styles')

    {!! Html::style('/assets/plugins/prismjs/prism.css') !!}
    {!! Html::style('/assets/plugins/@mdi/css/materialdesignicons.min.css') !!}
    {!! Html::style('/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}
    {!! Html::style('/assets/plugins/sweetalert2/sweetalert2.min.css') !!}
    {!! Html::style('/assets/plugins/toastr/toastr.css') !!}
    {!! Html::style('/assets/plugins/slick/slick.css') !!}
    {!! Html::style('/assets/plugins/slick/slick-theme.css') !!}
    {!! Html::style('/assets/plugins/cropperjs/cropper.min.css') !!}
    {!! Html::style('/assets/plugins/dropzone/dropzone.min.css') !!}
    {!! Html::style('/assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') !!}

@endpush

<div class=" profile-page tx-13">
    <div class="row">
        
        <div class="profile-header">
            <div class="cover">
                <div class="gray-shade"></div>

                
            
           

                <div class="cover-body d-flex justify-content-between align-items-center">
                    <div>
                        <img class="profile-pic" src="{{ url('storage/app/'.$facility->Media->url) }}" alt="">
                        <span class="profile-name">{!! $facility->name !!}</span>
                    </div>

                    <div wire:click="edit({{ $facility->id }})" class="d-none d-md-block pl-5">
                        <button class="btn btn-primary btn-sm btn-edit-profile"><i data-feather="edit-3" class="btn-icon-prepend"></i>
                                Edit
                        </button>
                    </div>
                </div>

            </div>

            <div class="header-links">
                <ul class="links d-flex align-items-center mt-3 mt-md-0 nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                    <li class="header-link-item d-flex align-items-center ">
                        <i class="mr-1 icon-md" data-feather="columns"></i>
                        <a class="nav-link active" id="menus-line-tab" data-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="true">Menus</a>
                    </li>
                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <i class="mr-1 icon-md" data-feather="monitor"></i>
                        <a class="nav-link" id="displays-line-tab" data-toggle="tab" href="#monitors" role="tab" aria-controls="profile" aria-selected="false">Displays</a>
                    </li>
                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <i class="mr-1 icon-md" data-feather="users"></i>
                        <a class="nav-link" id="position-line-tab" data-toggle="tab" href="#positions" role="tab" aria-controls="positions" aria-selected="false">Positions</a>
                    </li>
                    {{-- @if(Auth::user()->hasRole(['Platform Admin','Corporate Admin','Facility Admin','Facility Editor']))
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                            <i class="mr-1 icon-md" data-feather="users"></i>
                            <a class="nav-link" id="announcement-line-tab" data-toggle="tab" href="#announcement" role="tab" aria-controls="announcement" aria-selected="false">Announcement</a>
                        </li>
                    @endif
                    @if(Auth::user()->hasRole(['Platform Admin','Corporate Admin','Facility Admin','Facility Editor']))
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                            <i class="mr-1 icon-md" data-feather="image"></i>
                            <a class="nav-link" id="banners-line-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="false">Banners</a>
                        </li>
                    @endif --}}

                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>

     {{-- <div  class=" tab-content profile-body"  id="lineTabContent">
        <div class="tab-pane  fade active show" id="menu" role="tabpanel" aria-labelledby="menu-line-tab">
                @include('livewire.facility.incs.menu')
        </div> --}}

      {{--  <div class="tab-pane fade " id="monitors" role="tabpanel" aria-labelledby="monitors-line-tab">
            @include('facility.settings.incs.monitors')
        </div>
        <div class="tab-pane fade " id="positions" role="tabpanel" aria-labelledby="positions-line-tab">
            @include('facility.settings.incs.positions')
        </div> --}}
        {{-- @if(Auth::user()->hasRole(['Platform Admin','Corporate Admin','Facility Admin','Facility Editor']))
            <div class="tab-pane fade " id="announcement" role="tabpanel" aria-labelledby="announcement-line-tab">
                @include('facility.settings.incs.announcement')
            </div>
        @endif
        @if(Auth::user()->hasRole(['Platform Admin','Corporate Admin','Facility Admin','Facility Editor']))
            <div class="tab-pane fade " id="banners" role="tabpanel" aria-labelledby="banners-line-tab">
                @include('facility.settings.incs.banners')
            </div>
        @endif --}}

    </div>


</div>

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/prismjs/prism.js') !!}
    {!! Html::script('/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}
    {!! Html::script('/assets/plugins/sweetalert2/sweetalert2.min.js') !!}
    {!! Html::script('/assets/plugins/toastr/toastr.min.js') !!}
    {!! Html::script('https://cdn.ckeditor.com/ckeditor5/19.1.1/classic/ckeditor.js') !!}
    {!! Html::script('/assets/plugins/slick/slick.min.js') !!}
    {!! Html::script('/assets/plugins/cropperjs/cropper.min.js') !!}
    {!! Html::script('/assets/plugins/dropzone/dropzone.min.js') !!}
    {!! Html::script('/assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') !!}
    {!! Html::script('/assets/customjs/image-compressor.min.js') !!}
@endpush

@push('custom-scripts')
    <script>
        var facilityId = {!! $facility->id !!}
        var appUrl = "{!! env('APP_URL') !!}"
        var refreshRate = parseInt({!! env('CLIENT_PING_REFRESH_RATE', 300000) !!})
    </script>
    {!! Html::script('/js/custom/facilityprofile.js?v=1.3') !!}
    {!! Html::script('/js/custom/toastr.js?v=2') !!}

    <script>




        // Echo.channel('display-status-' + facilityId)
        //             .listen('OnlineStatus', (e) => {
        //                 updateOnlineStatus(e.identifier);
        //             });

        // function updateOnlineStatus(identifier) {
        //     element = $('.displayOnlineStatus_' + identifier);
        //     element.removeClass('text-danger');
        //     element.addClass('text-success');
        //     element.text('Online');
        // }

        // function resetDisplayStatus() {
        //     $('.display').each((index, item) => {
        //         $(item).removeClass('text-success')
        //         $(item).addClass('text-danger');
        //         $(item).text('Offline');
        //     });
        // }


//        resetDisplayStatus();

        // setInterval(resetDisplayStatus, refreshRate + 100000);


        $('#VidedoForm').submit(function (ev) {

            ev.preventDefault();
            let url = '/banner/';
            let method = 'post';

            if ($('#video_banner_id').val()){
                url = '/banner/'+$('#video_banner_id').val();
                method = 'PATCH';
            }

            /* dataForm = new FormData(this)
             dataForm.append('facility_id',facilityId)*/
            dataForm = new FormData(this)
            dataForm.append('facility_id',facilityId)
            dataForm.append('video',1);



            $.ajax(url, {
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.progress').removeClass('d-none');
                            $('.progress-bar').css('width',percentComplete+'%')
                            $('.progress-bar').text(percentComplete+'%')

                            if (percentComplete === 100) {
                                $('.progress').addClass('d-none');
                                $('.progress-bar').css('width','0%')
                                $('.progress-bar').text('0%')
                            }

                        }
                    }, false);

                    return xhr;
                },
                type: 'POST',
                data: dataForm,
                headers: {"X-HTTP-Method-Override": method},
                processData: false,
                contentType: false,
                success: function (response) {


                    if (!response.success){
                        $.each(response.message,function (key,val) {
                            $('#error-video_'+key).text(val)
                            $('#video_'+key).addClass('is-invalid')
                        })
                        return;
                    }

                    $('#bannerModal-video').modal('hide')
                    getBanners();
                }

            });
        })
    </script>
@endpush

