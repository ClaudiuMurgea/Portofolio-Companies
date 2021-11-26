<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper bg-primary"><a href="{{ route('livewire.company') }}"><img class="img-fluid" src="{{asset('assets/images/logo.png')}}" alt=""></a></div>
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">    </i></div>
    </div>

    <div class="nav-right col pull-right right-menu">
      <ul class="nav-menus">   
        <li class="onhover-dropdown p-0">

          <a href="{{ url('/logout') }}"><img class="img-fluid" src="{{asset('assets/images/userSmall.png')}}" alt=""></a>

        </li>
      </ul>   
    </div>

  </div>
</div>
