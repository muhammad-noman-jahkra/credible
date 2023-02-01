@extends('layouts.dashboard')

@section('title')
Tasks List
@endsection


@section('content')

 <!-- Page Wrapper -->
 <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Tasks List</h3>
                    </div>
                </div>
                
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Search filters</h5>
                    <div class="row filter-row">
                        <div class="col-sm-3">  
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input type="text" class="form-control floating" id="taskRangeDate" name="taskRangeDate">
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
                                    <th>Task Id</th>
                                    <th>Task Tile</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }} </td>
                                    <td>{{ $task->name }} </td>
                                    <td>{{ $task->priority }}</td>
                                    <td>{{ $task->lastTaskMeta->status }} </td>
                                    <td>{{ $task->created_at }} </td>
                                    <td>{{ $task->priority }}</td>
                                    
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('task.show',[$task->id])}}" target="_blank"><i class="fa fa-eye m-r-5"></i> View</a>
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
    $('#taskRangeDate').daterangepicker();
</script>
@endsection