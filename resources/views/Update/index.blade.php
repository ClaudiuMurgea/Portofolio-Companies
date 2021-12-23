@extends('layouts.admin.master')

@section('title', 'Updates')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
@endpush

@section('content')

  <div class="container-fluid">
    <div class="row starter-main">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>News</h5>
                    <div class="setting-list">
                        <ul class="list-unstyled setting-option">
                            <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                            <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <p><span class="f-w-600">Title</span></p>
                    <p>Information </p>
                    <p><span class="f-w-600">Details</span></p>
                    <p>
                      Extra information
                    </p>
                    <div class="alert alert-primary inverse" role="alert">
                        <i class="icon-info-alt"></i>
                        <h5>Important!</h5>
                        <p>Reminder</p>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Updates Title</h5>
                                <div class="setting-list">
                                    <ul class="list-unstyled setting-option">
                                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>
                                    Update body - Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

  @push('scripts')
  <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
  <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
  <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
  <script src="{{asset('assets/js/tooltip-init.js')}}"></script>
  @endpush

@endsection