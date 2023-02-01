
<div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Attendance Report</h3>
                    </div>
                </div>
                
            </div>

            <div class="card">
            
                <div class="card-body">
                <h1 class="card-title">Filters</h1>
                    <div class="row filter-row">
                        <div class="col-sm-3">  
                            <div class="form-group">
                            <label class="col-form-label">Year</label>
                                
                                    {{ Form::select('year',$yearList,null,array('placeholder'=>'Select','class'=>'form-control','wire:model.defer'=>"year"))}}
                                
                                
                            </div>
                        </div>
                        <div class="col-sm-3">  
                            <div class="form-group">
                            <label class="col-form-label">Month</label>
                                
                                    {{ Form::select('month',$monthList,null,array('placeholder'=>'Select','class'=>'form-control','wire:model.defer'=>"month"))}}
                                                        
                            </div>
                        </div>
                        @if(!Auth::user()->hasRole(['EMPLOYEE']))
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label">Emp Name </label>
                                {{ Form::select('empName',$empList,null,array('placeholder'=>'Select','class'=>'form-control','wire:model.defer'=>"empName"))}}
                            </div>
                        </div>
                        @endif

                        <div class="col-sm-6 col-md-3">  
                            <div class="form-group">
                                <label class="col-form-label"> </label>
                                <button type="sumit" class="btn btn-success btn-block" wire:click="getAttendanceReport()"> Search </button>  
                            </div>
                        </div>
                    </div>
                
                    
                </div>
            </div>            
            @if($updateMode)
                @include('livewire.report.attendance-report-summary')
            @endif
            
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Details</h1>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table datatable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>In Time</th>
                                            <th>Out Time</th>
                                            <th>Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                        @foreach($att as $a)
                                        <tr>
                                            <td>{{ $a->day}} </td>
                                            <td>{{ $a->in_time}} </td>
                                            <td>{{ $a->out_time}} </td>
                                            <td>{{ $a->calAttendanceWorkingHour().'hrs' }} </td>                                   
                                            
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

      
        </div>
        <!-- /Page Content -->
</div>