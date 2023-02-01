@extends('layouts.dashboard')

@section('title')
Tasks Details
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
                        <h3 class="page-title">Tasks Details</h3>
                    </div>
                </div>
                
            </div>
            <!-- /Page Header -->

            
            <div class="card">
                <div class="card-body">
                    
                    
                    <div class="row filter-row">
                    
                        <div class="col-sm-11">
                            <h5 class="card-title"><b>Title : </b>{{$task->name}}</h5>
                            <p>
                                <b>Current Status : </b>{{$task->lastTaskMeta->status??''}}<br>
                                <b>Description : </b>{{$task->description}}
                            </p>
                        </div>
                        @if(Auth::user()->hasRole(['EMPLOYEE']))
                        <div class="col-sm-1">
                            <a href="#" class="btn add-btn" id="btn-actions" >Actions</a> 
                        </div>
                        <div class="col-sm-12" style="display:none" id="action-div">  
                            <div class="card">
                                
                                <div class="card-body">
                                    {{ Form::open(array('route'=>array('task.updates',[$task->id]),'method'=>'POST','files'=>'true'))}}
                                        @csrf
                                        <label for="remarks">Remarks</label>
                                        <textarea name="remarks" class="form-control" id="" cols="50" rows="2"></textarea>
                                        <label for="files">files</label>
                                        <input type="file" name="files[]" class="form-control" multiple>
                                        <br>
                                        <input type="submit" class="btn btn-primary" name="status" value="START">
                                        <input type="submit" class="btn btn-warning" name="status" value="STOPPED">
                                        <input type="submit" class="btn btn-success" name="status" value="COMPLETE">
                                        <input type="submit" class="btn btn-info" name="status" value="UPDATES">
                                        
                                        {{ Form::close() }}
                             
                                
                                </div>

                            </div>
                            
                            
                            
                        </div>     
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card recent-activity">
                        <div class="card-body">
                            <h5 class="card-title">Last Activity</h5>
                            <ul class="res-activity-list">
                                @foreach($task->taskMeta as $t)
                                    <li>
                                        <p class="mb-0">{{$t->taskMetaEmployee->name}} - {{$t->status}}</p>                                        
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o"></i>
                                            {{$t->created_at}}
                                        </p>
                                        <p class="mb-0">{{$t->remarks}}</p>
                                    </li>                                    
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Task Files</h5>
                            <table class="table table-striped custom-table datatable">
                                @foreach($task->taskAttachments as $a)
                                    <tr>
                                        <td><a href="{{URL('storage/taskAttachments/'.$a->task_attachment_url)}}" target="_blank" rel="noopener noreferrer">{{$a->filename}}</a></td>
                                    </tr>
                                @endforeach                                
                            </table>
                        </div>
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
    $('#btn-actions').on('click',function(){
        $('#action-div').toggle();
    });
</script>
@endsection