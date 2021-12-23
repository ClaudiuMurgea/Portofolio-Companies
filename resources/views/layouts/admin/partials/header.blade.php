<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper bg-primary"><a href="{{ route('livewire.company') }}"><img class="img-fluid" src="{{asset('assets/images/logo.png')}}" alt=""></a></div>
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">    </i></div>
    </div>

    <div class="nav-right col pull-right right-menu">
      <ul class="nav-menus">   
        <li class="onhover-dropdown p-0">

          <img class="img-fluid" src="{{asset('assets/images/userSmall.png')}}" alt="">
          
          <li class="nav-item dropdown bg-transparent">
            <a id="navbarDropdown" class=" nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
              <a class="dropdown-item text-white btn btn-sm bg-primary text-center font-weight-bold" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out text-white"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>

                  {{ __('Logout') }}
              </a>
              
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
          </li>
          
        </li>
      </ul>   
    </div>

  </div>
</div>
