<div class="card rounded">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="card-title mb-0">Menus</h6>

        </div>
        <div class="row">
            <div class="forum-group col-4 mt-4">
                <div class="col-12">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Using:</label>

                    <p class="text-muted edit_schedule_type {!! $facility->Settings->schedule_type ? '' : 'd-none'!!}">
                        <span class="title">{!! $facility->Settings->schedule_type ? $facility->Settings->Schedule->description : ''!!}</span>
                        <i  class="text-warning mdi mdi-lead-pencil edit"></i>
                    </p>
                </div>

                {!! Form::open([
                    'class' => 'editSettings',
                    'type'  => 'schedule_type'
                ]) !!}


                <div class="form-group row schedule_type {!! ($facility->Settings->schedule_type) ? 'd-none' : '' !!}" >
                    <div class="col-8">
                        <select class="form-control" name="value" id="schedule" required>
                            <option value="">Choose</option>
                            @foreach($scheduleTypes as $type)
                            <option {!! $facility->Settings->schedule_type == $type->id ? 'selected' : '' !!} value="{!! $type->id !!}">{!! ucfirst($type->name) !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="recurrent" {!! $facility->Settings->recurrence_menu ? 'checked' : '' !!}>
                                Recurrent
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group schedule_type {!! ($facility->Settings->schedule_type) ? 'd-none' : '' !!}">
                    <div class="col-12">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase schedule_type {!! ($facility->Settings->schedule_type) ? 'd-none' : '' !!}">Pick start date for cycle:</label><br>
                        <div class="input-group input-group mb-2  schedule_type {!! ($facility->Settings->schedule_type) ? 'd-none' : '' !!}" >
                            <input type="text" name="start_date"  class="form-control datepicker" value="{!! $facility->Settings->cycle_startdate ? \Carbon\Carbon::parse($facility->Settings->cycle_startdate)->format('Y-m-d') : '' !!}">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-check "></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>


                {!! Form::close() !!}
                <span class="text-danger" id="error-schedule"></span>
            </div>
            <div class="col-3"></div>
            @if(isset($startingCycles))
            {!! Form::open([
                    'class' => 'col-5',
                       'action' => 'MenuItemsController@import',
                       'files'  => true
                ]) !!}
            <input type="hidden" name="facilityId" value="{!! $facility->id !!}">
            <div class="row">
                <div class="forum-group col-6 mt-4">
                    <p class="tx-11 font-weight-bold mb-0 text-uppercase">Import Menu:</p>
                    <label class="title text-muted">Select File</label>
                    <div class="input-group input-file">

                        <input type="text" class="form-control" placeholder='Choose a file...' name="file" required/>
                        <span class="input-group-append">
                                    <button class="btn btn-light btn-choose" type="button">Choose</button>
                                </span>

                    </div>
                    @error('file')
                        <span class="text-danger">{!! $message !!}</span>
                    @enderror


                </div>

                <div class="forum-group col-6 mt-4">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase"></label>
                    <br>
                    <label class="title text-muted">Cycle start</label>
                    <div class="input-group input-group mb-2" >
                        <select type="text" name="start_date"  class="form-control" required id="cycle_start_date">
                            <option value="">Select</option>
                            @foreach($startingCycles as $startCycle)
                                <option value="{!! $startCycle !!}">{!! $startCycle !!}</option>
                            @endforeach
                        </select>
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-check "></i></button>
                        </span>
                    </div>
                    @error('start_date')
                        <span class="text-danger">{!! $message !!}</span>
                    @enderror
                </div>

            </div>
            {!! Form::close() !!}
            @endif
        </div>
    </div>
    <div class="card-body">

        <div class="item" style="width: 100%; display: inline-block;">
            <div class="row">
                <div class="col-3 float-letf">
                    <a  class="text-primary" id="left" class="d-none"><i data-feather="chevron-left"></i></a>
                </div>
                <div class="col-6"><h4 class="text-center text-primary today" id="today" onclick="getCalendar()">Today</h4></div>
                <div class="col-3 text-right">
                    <a  class="text-primary" id="right" ><i data-feather="chevron-right"></i></a>
                </div>
            </div>
            <br>
            <ul class="d-flex justify-content-between" id="calendar">


            </ul>
        </div>
    </div>
    @include('facility.settings.incs.dailyMenu')
</div>
