@extends('layouts.admin.master')

@section('title')
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
@endpush

@section('content')
  @component('components.breadcrumb')
    @slot('breadcrumb_title')
      <h3>Companies</h3>
    @endslot
    <li class="breadcrumb-item">All Companies</li>
  @endcomponent
  
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
                      Extra information / Consequences
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

  @push('scripts')
  <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
  <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
  <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
  <script src="{{asset('assets/js/tooltip-init.js')}}"></script>
  @endpush

  <footer class="footer fixed-bottom pl-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 footer-copyright">
          <p class="mb-0">Copyright {{date('Y')}}-{{date('y', strtotime('+1 year'))}} © viho All rights reserved.</p>
        </div>
        <div class="col-md-6">
          <p class="pull-right mb-0">Hand crafted & made with <i class="fa fa-heart font-secondary"></i></p>
        </div>
      </div>
    </div>
  </footer>
@endsection