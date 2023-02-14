<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\User;
use App\Http\Requests\StoreemployeeRequest;
use App\Http\Requests\UpdateemployeeRequest;
use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

    public function __construct() {        

        $this->middleware(['role:ADMIN|SUPER_ADMIN'])->only(['edit','store','create','update']); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = employee::all();
        return view('employee.list_emp',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.add_emp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreemployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email', '=',$request->email)->first();

        if (!empty($user))
        {
            Toastr::error('Email is already exist :(','Error');
            return redirect()->back();
        }
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email',
            'dob'   => 'required|date',
            'doj'   => 'required|date',
            'gender'      => 'in:MALE,FEMALE',
            'phone_no'       => 'required|string',
            'address'       => 'string',
        ]);

        DB::beginTransaction();
        try{

            $employees = Employee::where('email', '=',$request->email)->first();
            if ($employees === null)
            {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                if($user->save()){
                    
                    $user->assignRole('EMPLOYEE');

                    $employee = new Employee;
                    $employee->name  = $request->name;
                    $employee->email = $request->email;
                    $employee->dob   = date("Y-m-d", strtotime($request->dob));
                    $employee->doj   = date("Y-m-d", strtotime($request->doj));
                    $employee->gender       = $request->gender;
                    $employee->user_id= $user->id;
                    $employee->phone_no= $request->phone_no;
                    $employee->address= $request->address;
                    
                    if($employee->save()){
                        DB::commit();
                        Toastr::success('Add new employee successfully :)','Success');
                        return redirect()->route('emp.index');
                    }else{
                        DB::rollback();
                        // dd($user->getErrors());
                        Toastr::error('Something went wrong :(','Error');
                        return redirect()->back();        
                    }

                }else{
                    DB::rollback();
                    dd($user->getErrors());
                    Toastr::error('Something went wrong :(','Error');
                    return redirect()->back();        
                }
                
            } else {
                DB::rollback();
                Toastr::error('Email is already exist :)','Error');
                return redirect()->back();
            }
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Add new employee fail :)','Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $emp)
    {
        return view('employee.edit_emp',compact('emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateemployeeRequest  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $emp)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'dob'   => 'required|date',
            'doj'   => 'required|date',
            'gender'      => 'in:MALE,FEMALE',
            'phone_no'       => 'required|string',
            'address'       => 'string',
        ]);

        DB::beginTransaction();
        try{

            $emp->name  = $request->name;
            $emp->dob   = date("Y-m-d", strtotime($request->dob));
            $emp->doj   = date("Y-m-d", strtotime($request->doj));
            $emp->gender       = $request->gender;
            $emp->phone_no= $request->phone_no;
            $emp->address= $request->address;
            
            if($emp->save()){
                $user = $emp->user;
                $user->name = $request->name;
                $user->save();
                DB::commit();
                Toastr::success('Employee Updated successfully :)','Success');
                return redirect()->route('emp.index');
            }else{
                DB::rollback();
                // dd($user->getErrors());
                Toastr::error('Something went wrong :(','Error');
                return redirect()->back();        
            }

           
                
           
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Employee Update fail :)','Error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        //
    }
    
    public function updateEmpPassword()
    {
        if($_POST['password'] == $_POST['confirm_password']){
            $user = Auth::user();
            $user->password = bcrypt($_POST['password']);
            $user->save();
            Toastr::success('Password has been updated :)','Success');
            return redirect()->route('home');
        }else{
            Toastr::error('password and confirm Passwor must be same :(','Error');
            return redirect()->back();
        }
    }
}
