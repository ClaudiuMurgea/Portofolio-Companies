<div>
    @section( 'title', 'HC Dash' )

    @if ( Auth::user()->hasAnyRole(['Corporate Admin', 'Facility Admin', 'Facility Editor']) || auth()->user()->hasAnyRole('Platform Admin|Regional Admin') )
        @if ( ( Auth::user()->companyAdmin()->exists() &&  auth()->user()->companyAdmin->first()->company_id == $facilityID ) || in_array($facilityID, $facilityIDS) || auth()->user()->hasAnyRole('Platform Admin|Regional Admin') )
            <div class="col-xl-12 col-md-6 box-col-6 des-xl-50">
                <div class="card profile-greeting">
                    <div class="card-body bg-success p-1">
                        <img style="height: 360px;width:1860px;" class="img-fluid"  src="{{ url('/defaults/default-banner.jpg') }}" class="img-fluid" alt="profile cover">
                    </div>
                </div>
            </div>

            <div class="profile-page tx-13 mb-5">
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="profile-header">
                            <div class="header-links d-flex justify-content-center">
                                <ul class="links d-flex align-items-center align-items-baseline mt-3 mt-md-0 nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">

                                    <li wire:click="show('showMenus')" class="header-link-item d-flex align-items-center">
                                        <a class="nav-link" id="menus-line-tab" data-toggle="tab" href="#menu" role="tab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                            Menus
                                        </a>
                                    </li>

                                    <li wire:click="show('showDisplays')" class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                    
                                        <a class="nav-link" id="displays-line-tab" data-toggle="tab" href="#monitors" role="tab" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                            Displays
                                        </a>
                                    </li>

                                    <li wire:click="show('showPositions')" class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                        <a class="nav-link" id="position-line-tab" data-toggle="tab" href="#positions" role="tab" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                            Positions
                                        </a>
                                    </li>

                                    <li wire:click="show('showAnnouncements')" class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                        <a class="nav-link" id="announcement-line-tab" data-toggle="tab" href="" role="tab" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                                            Announcements
                                        </a>
                                    </li>

                                    <li wire:click="show('showBanners')" class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                        <a class="nav-link" id="banners-line-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                            Banners
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                            
                @if($showMenus == true)
                    <livewire:facility.settings.menus.menus-index :facility="$facilityID" />
                @endif

                @if ($showDisplays == true)
                    <livewire:facility.settings.displays.displays-index :facility="$facilityID" />
                @endif

                @if ($showPositions == true)
                    <livewire:facility.settings.positions.positions-index :facility="$facilityID" />
                @endif

                @if ($showAnnouncements == true)
                    <livewire:facility.settings.announcements.announcements-index :facility="$facilityID" />
                @endif

                @if ($showBanners == true)
                    <livewire:facility.settings.banners.banners-index :facility="$facilityID" />
                @endif
            </div>

            <script>
            new Pikaday({ field: document.getElementById('datepicker') })

                picker = new Pikaday({
                field: document.getElementById('datepicker'),
                firstDay: 0,
                pickWholeWeek: true,
                setDefaultDate: true,
                minDate: new Date(2021, 11, 14),
                maxDate: new Date(2030, 12, 14),
                yearRange: [2021,2030],

                disableDayFn: function(theDate) {
                return false;
                }
            });
            </script>
        @endif
    @endif

</div>

