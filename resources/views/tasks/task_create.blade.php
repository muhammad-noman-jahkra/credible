@extends('layouts.dashboard')

@section('title')
Add Task
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
                        <h3 class="page-title">Add Task</h3>
                    </div>                    
                </div>
                
            </div>
            <!-- /Page Header -->

        
        <!-- /Page Content -->

            <div>
                {{ Form::open(array('route'=>'task.store','method'=>'POST','files'=>'true'))}}
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Task Title</label>
                                {{ Form::text('name',null,array('placeholder'=>'Tour Title','class'=>'form-control'))}}
                                @if($errors->has('name'))
                                    <span>{{$errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label"> Priority<span class="text-danger">*</span></label>
                                
                                {{ Form::select('priority',$taskPriority,null,array('placeholder'=>'Task Priority','class'=>'select form-control'))}}
                                @if($errors->has('priority'))
                                    <span>{{$errors->first('priority')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">AssignTo <span class="text-danger">*</span></label>
                                {{ Form::select('assignTo',$empList,null,array('placeholder'=>'Select','class'=>'form-control'))}}
                                @if($errors->has('assignTo'))
                                    <span>{{$errors->first('assignTo')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Files <span class="text-danger"></span></label>
                                {{ Form::file('files[]',array('multiple'=>'multiple','class'=>'form-control'))}}
                                @if($errors->has('files'))
                                    <span>{{$errors->first('files')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Task description</label>
                                
                                {{ Form::textarea('description',null,array('placeholder'=>'Task Description','class'=>'form-control'))}}
                                @if($errors->has('description'))
                                    <span>{{$errors->first('description')}}</span>
                                @endif
                                
                            </div>
                        </div>
                        
                    </div>                            
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        <!-- /Page Content -->
        </div>
   
    </div>
    <!-- /Page Wrapper -->

@endsection

@section('script')
<script>
</script>
@endsection