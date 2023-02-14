@extends('layouts.dashboard')
@section('content')
  
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ __('Update Password') }}</h3>         
                        <h5 >{{ __('Ensure your account is using a long, random password to stay secure.') }}</h5>                        
                    </div>                   
                </div>
            </div>
			<!-- /Page Header -->

            <form action="{{route('emp.updatePassword')}}" method="POST">
                @csrf
                <div class="row ">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="password" class="form-control floating" name="password">
                            <label class="focus-label">New Password</label>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="password" class="form-control floating" name="confirm_password">
                            <label class="focus-label">Confirm Password</label>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-6 col-md-3">  
                        <button type="sumit" class="btn btn-success btn-block"> Update </button>  
                    </div>
                </div>
            </form>            
            
        </div>
        <!-- /Page Content -->
      
    </div>
    <!-- /Page Wrapper -->
   
@endsection
