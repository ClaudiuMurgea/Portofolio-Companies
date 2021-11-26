<header class="main-nav">
    <nav>
        <div class="main-navbar">
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="{{route('livewire.company')}}"><span> <i data-feather="list"></i>Companies</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="{{ route('livewire.display') }}"><span> <i data-feather="monitor"></i>Display Types</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="{{ route('livewire.region') }}"><span> <i data-feather="map"></i>Regions</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="{{route('livewire.user')}}"><span> <i data-feather="users"></i>Users</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="{{ route('livewire.user') }}" target="_blank"><span> <i data-feather="radio"></i>Updates</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>