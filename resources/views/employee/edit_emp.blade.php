@extends('layouts.dashboard')

@section('title')
Edit Employee
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
                        <h3 class="page-title">Edit Employee</h3>
                    </div>                    
                </div>
                
            </div>
            <!-- /Page Header -->

        
        <!-- /Page Content -->    
            <div>
                {{ Form::open(array('route'=>array('emp.update',$emp->id),'method'=>'PUT','files'=>'true'))}}
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Full Name</label>
                                {{ Form::text('name',$emp->name,array('placeholder'=>'Full Name','class'=>'form-control'))}}
                                @if($errors->has('name'))
                                    <span>{{$errors->first('name')}}</span>
                                @endif                                
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                {{ Form::email('email',$emp->email,array('placeholder'=>'email','class'=>'form-control','disabled'=>'disabled'))}}                                                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Birth Date</label>
                                <div class="cal-icon">
                                    {{ Form::date('dob',$emp->dob,array('class'=>'form-control datetimepicker'))}}
                                    @if($errors->has('dob'))
                                        <span>{{$errors->first('dob')}}</span>
                                    @endif    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Joining Date</label>
                                <div class="cal-icon">
                                    {{ Form::date('doj',$emp->doj,array('class'=>'form-control datetimepicker'))}}
                                    @if($errors->has('doj'))
                                        <span>{{$errors->first('doj')}}</span>
                                    @endif 
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                {{ Form::select('gender',['MALE'=>'Male','FEMALE'=>'Female'],$emp->gender,array('placeholder'=>'Select','class'=>'select form-control'))}}
                                @if($errors->has('gender'))
                                    <span>{{$errors->first('gender')}}</span>
                                @endif
                                
                            </div>
                        </div>                       

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Phone No</label>
                                {{ Form::text('phone_no',$emp->phone_no,array('placeholder'=>'03XXXXXXXX','class'=>'form-control'))}}
                                @if($errors->has('phone_no'))
                                    <span>{{$errors->first('phone_no')}}</span>
                                @endif                                
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Address</label>
                                {{ Form::text('address',null,array('placeholder'=>'Address','class'=>'form-control'))}}
                                @if($errors->has('address'))
                                    <span>{{$errors->first('address')}}</span>
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