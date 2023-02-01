<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\User;
use App\Models\employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use function PHPUnit\Framework\isEmpty;

class AttendanceController extends Controller
{

    public function __construct() {        

        $this->middleware(['role:EMPLOYEE'])->only(['edit']); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $att = Attendance::orderBy('id', 'desc');
        
        // if(attendanceRange){
        //     att->whereBetween('created_at', [Range of Value]);
        // }
        
        // if(Auth::user()->hasRole(['EMPLOYEE'])){
        //     $emp = employee::andWhere(['user_id'=>Auth::user()->id])->first();
        //     $att->where(['user_id'=>$emp->id]);
        // }
        
        
        // $att = $att->get();       
        
        // return view('attendance.att_hist',compact(['att']));
        return view('attendance.att_hist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        dd(123);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttendanceRequest  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function punch(Request $request){
        
        $emp = employee::where(['user_id'=>Auth::user()->id])->first();

        $att = Attendance::where(['user_id'=>$emp->id])->orderBy('id', 'desc')->first();

        if(empty($att)){
            $att = new Attendance;
            $att->in_time = date("Y-m-d H:i:s");
            $att->punch_in_ip = $request->ip();
            $att->day = date("Y-m-d");
            $att->user_id = $emp->id;
            $att->attendance_type = 'EMPLOYEE';
            $att->device_type = $request->userAgent();
            $att->save();

            Toastr::success('Updated Successfully :)','Success');
            return redirect()->route('home');

        }else if(!empty($att) && empty($att->out_time)){
            
            $att->out_time = date("Y-m-d H:i:s");
            $att->punch_out_ip = $request->ip();
            $att->save();

            Toastr::success('Updated Successfully :)','Success');
            return redirect()->route('home');

        }else if (!empty($att) && !empty($att->out_time) && !empty($att->in_time)){

            $att = new Attendance;
            $att->in_time = date("Y-m-d H:i:s");
            $att->punch_in_ip = $request->ip();
            $att->day = date("Y-m-d");
            $att->user_id = $emp->id;
            $att->attendance_type = 'EMPLOYEE';
            $att->device_type = $request->userAgent();
            $att->save();

            Toastr::success('Updated Successfully :)','Success');
            return redirect()->route('home');
        }

        Toastr::success('Something went wrong :(','Error');
        return redirect()->route('home');
        
    }
}
