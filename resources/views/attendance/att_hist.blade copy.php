@extends('layouts.dashboard')

@section('title')
Attendance History
@endsection


@section('content')

 <!-- Page Wrapper -->
 <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Attendance History</h3>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="card">
                <div class="card-body">
                    <div class="row filter-row">
                        <div class="col-sm-3">  
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input type="text" class="form-control floating" id="attendanceRange" name="attendanceRange">
                                </div>
                                <label class="focus-label">Date</label>
                            </div>
                        </div>
                    </div>
                
                    <div class="row filter-row">
                    
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3 pull-right">  
                            <a href="#" class="btn btn-success btn-block"> Search </a>  
                        </div>     
                    </div>
                </div>
            </div>

            <!-- /Search Filter -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Emp Name</th>
                                    <th>Punch In</th>
                                    <th>Punch Out</th>
                                    <th>Production</th>
                                    <th>Punch In Ip</th>
                                    <th>Punch Out Ip</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($att as $attendance)
                                <tr>
                                    <td>{{ $attendance->day }} </td>
                                    <td>{{ $attendance->employee->name }} </td>
                                    <td>{{ $attendance->in_time }}</td>
                                    <td>{{ $attendance->out_time }}</td>
                                    <td>{{ $attendance->day }}</td>
                                    <td>{{ $attendance->punch_in_ip }}</td>
                                    <td>{{ $attendance->punch_out_ip }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('attendance.edit',$attendance->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        </div>
        <!-- /Page Content -->

   
    </div>
    <!-- /Page Wrapper -->

@endsection

@section('script')
<script>
    $('#attendanceRange').daterangepicker({
        startDate:new Date(), // after open picker you'll see this dates as picked
        endDate:new Date(),
        locale: {
        format: 'YYYY-MM-DD',
        
        }
    });
</script>
@endsection