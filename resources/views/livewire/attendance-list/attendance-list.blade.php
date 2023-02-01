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
           

            <!-- /Search Filter -->
            @if($updateMode)
                @include('livewire.attendance-list.update_attendance')
            @else
                @include('livewire.attendance-list.search_attendance')
            @endif
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
                                    @if(!Auth::user()->hasRole(['EMPLOYEE']))
                                        <th class="text-right no-sort">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($att as $attendance)
                                <tr>
                                    <td>{{ $attendance->day }} </td>
                                    <td>{{ $attendance->employee->name }} </td>
                                    <td>{{ $attendance->in_time }}</td>
                                    <td>{{ $attendance->out_time }}</td>
                                    <td>{{ $attendance->calAttendanceWorkingHour().'hrs' }}</td>
                                    <td>{{ $attendance->punch_in_ip }}</td>
                                    <td>{{ $attendance->punch_out_ip }}</td>
                                    @if(!Auth::user()->hasRole(['EMPLOYEE']))
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item"  wire:click="edit({{ $attendance->id }})"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
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


@section('script')
<script>
    $('#dateRange').daterangepicker({
        // startDate:new Date(), // after open picker you'll see this dates as picked
        // endDate:new Date(),
        locale: {
        format: 'YYYY-MM-DD',
        },
        // onSelect: function(dateRange) {
        //     @this.set('dateRange', dateRange);
        // }
       
    });

    // $('#dateRange').on('change', function (e) {
    //    $(this).set('dateRange', e.target.value);
    // })
</script>
@endsection

