@extends('layouts.dashboard')

@section('title')
Dashboard
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
                        <h3 class="page-title">Dashboard</h3>                        
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-6">
                    <div class="card punch-status">
                        <div class="card-body">
                            <h5 class="card-title">Timesheet <small class="text-muted">{{date('d M Y')}}</small></h5>
                            @if(!empty($lastAtt) && empty($lastAtt->out_time))
                                <div class="punch-det">
                                    <h6>Punch In at</h6>
                                    <p>{{ date_format(new DateTime($lastAtt->in_time),"D,d M Y h:i")}}</p>
                                </div>
                            @endif
                            
                            <div class="punch-info">
                                <div class="punch-hours">
                                    @if(!empty($lastAtt) && empty($lastAtt->out_time))
                                        @php

                                            $datetime_2 = date("Y-m-d H:i:s"); 
                                            
                                            $start_datetime = new DateTime($lastAtt->in_time); 
                                            $diff = $start_datetime->diff(new DateTime($datetime_2)); 

                                            $total_hr = ($diff->days * 24); 
                                            $total_hr += $diff->h; 
                                            $total_hr += $diff->i / 60; 
                                            
                                            echo round($total_hr,2).'hrs';
                                        @endphp
                                        
                                    @else
                                    <span>0 hrs</span>
                                    @endif
                                </div>
                            </div>
                            <div class="punch-btn-section">
                                <form method="POST" action="{{ route('attendance.punch') }}" class="inline">
                                    @csrf

                                    <button type="submit" class="btn btn-primary punch-btn">
                                        @if(empty($lastAtt) || (!empty($lastAtt) && !empty($lastAtt->out_time)))
                                            Punch-In
                                        @else
                                            Punch-Out
                                        @endif
                                    </button>
                                </form>                                
                            </div>
                            <div class="statistics" style="display:none">
                                <div class="row">
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box">
                                            <p>Break</p>
                                            <h6>1.21 hrs</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box">
                                            <p>Overtime</p>
                                            <h6>3 hrs</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="display:none">
                    <div class="card att-statistics">
                        <div class="card-body">
                            <h5 class="card-title">Statistics</h5>
                            <div class="stats-list">
                                <div class="stats-info">
                                    <p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Overtime <strong>4</strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card recent-activity">
                        <div class="card-body">
                            <h5 class="card-title">Last Activity</h5>
                            <ul class="res-activity-list">
                                @foreach($att as $attandance)
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o"></i>
                                            {{$attandance->in_time}}
                                        </p>
                                    </li>
                                    @if(!empty($attandance->out_time))
                                        <li>
                                            <p class="mb-0">Punch Out at</p>
                                            <p class="res-activity-time">
                                                <i class="fa fa-clock-o"></i>
                                                {{$attandance->out_time}}
                                            </p>
                                        </li>
                                    @endif
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

        </div>
        <!-- /Page Content -->

   
    </div>

@endsection

@section('script')
<script>
    $('#punch-btn').on('click',function(){
        
    });
</script>
@endsection