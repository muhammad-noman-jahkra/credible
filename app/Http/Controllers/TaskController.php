<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskMeta;
use App\Models\TaskTrack;
use App\Models\TaskAttachements;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\employee;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('tasks.tasks_list');
        // $tasks = Task::orderBy('id', 'desc');
        
        // if(Auth::user()->hasRole(['EMPLOYEE'])){
        //     $emp = employee::where(['user_id'=>Auth::user()->id])->first();
        //     $tasks->with('taskMeta')->whereHas('taskMeta', function ($query) use($emp){
        //         $query->where('claimBy','=',$emp->id);
        //     });
        // }
        
        
        // $tasks = $tasks->get();       
        
        // if(Auth::user()->hasRole(['EMPLOYEE'])){
        //     return view('tasks.emp_tasks_list',compact(['tasks']));
        // }else{
        //     return view('tasks.tasks_list',compact(['tasks']));
        // }
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskPriority = array('NORMAL'=>'Normal','URGENT'=>'Urgent');
        $empList = employee::pluck('name','id');
        return view('tasks.task_create',compact('taskPriority','empList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'        => 'required|string|max:255',
            'description'       => 'required|string|max:2000',
            'priority'   => 'in:NORMAL,URGENT', 
            'assignTo'   => 'required|integer',
        ]);


        DB::beginTransaction();
        try {
            //code...
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Email is already exist :)','Error');
            return redirect()->back();
        }
        $task = new Task();

        $task->name = $request->name;
        $task->description  = $request->description ;
        $task->priority  = $request->priority ;
        $task->createdBy  = Auth::user()->id ;
        $task->modifiedBy  = Auth::user()->id ;

        if($task->save()){

            $taskMeta = new TaskMeta();
            $taskMeta->task_id = $task->id;
            $taskMeta->status = 'PENDING';
            $taskMeta->claimBy = $request->assignTo;

            if($taskMeta->save()){
                
                $allFiles = $request->files->all();
                foreach($request->file('files') as $key => $file)
                {
                    $path = $file->store($task->id,'taskAttachments');
                    $ta = New TaskAttachements();
                    $ta->task_id = $task->id;
                    // dd($request->file('files')[$index]);
                    $ta->task_attachment_url =  $path;
                    $ta->task_meta_id =  $taskMeta->id;
                    $ta->filename = $file->getClientOriginalName();
                    $ta->save();

                }

                DB::commit();
                Toastr::success('Task Created Successfully :)','Success');
                return redirect()->route('task.index');
            }else{
                DB::rollback();
                Toastr::error('Something went wrong :(','Error');
                return redirect()->route('task.index');
            }
        }else {
            DB::rollback();
            Toastr::error('Something went wrong :(','Error');
            return redirect()->route('task.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.task_view',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
    
    public function taskUpdates($taskId, Request $request)
    {
        $task = Task::find($taskId);
        
        if(!isset($_POST['status']) || (isset($_POST['status']) && empty($_POST['status']))){
            Toastr::error('Task Status is not provided :(','Error');
            return redirect()->back(); 
        }
        $taskStatus = $_POST['status'];
        if(empty($task)){
            Toastr::error('Task Id is not correct :(','Error');
            return redirect()->route('task.index'); 
        }
        $lastTaskStatus = $task->LastTaskMeta;
        if(Auth::user()->hasRole(['EMPLOYEE'])){
            
            $currentLoginEmp = employee::where(['user_id'=>Auth::user()->id])->first();
    
            if($currentLoginEmp->id != $lastTaskStatus->claimBy){
                Toastr::error('You have no rights to update different user tasks :(','Error');
                return redirect()->route('task.index'); 
            }
        }

        DB::beginTransaction();
        if($taskStatus == 'START'){
            
            if(!empty($lastTaskStatus) && in_array($lastTaskStatus->status,['STOPPED','PENDING'])){
                
                $tm = new TaskMeta() ;
                $tm->task_id = $taskId;
                $tm->status = $taskStatus;
                $tm->claimBy = $lastTaskStatus->claimBy;
                $tm->remarks = $_POST['remarks'];
                if($tm->save()){
                    $tt = new TaskTrack();
                    $tt->task_id = $taskId;
                    $tt->task_meta_id_start = $tm->id;
                    $tt->start_time = date("Y-m-d h:i:s");
                    $tt->save();

                    if(!empty($request->file('files'))){
                        foreach($request->file('files') as $key => $file)
                        {
                            $path = $file->store($task->id,'taskAttachments');
                            $ta = New TaskAttachements();
                            $ta->task_id = $task->id;
                            // dd($request->file('files')[$index]);
                            $ta->task_attachment_url =  $path;
                            $ta->task_meta_id =  $tm->id;
                            $ta->filename = $file->getClientOriginalName();
                            $ta->save();

                        }
                    }
                    
                    DB::commit();

                    Toastr::success('Task started :)','Success');
                    return redirect()->route('task.show',[$taskId]); 
                }else{
                    DB::rollback();
                    Toastr::error('Something went wrong :(','Error');
                    return redirect()->route('task.show',[$taskId]); 
                }

            }else{
                DB::rollback();
                Toastr::error('Only Pending or Stopped Task can be start :(','Error');
                return redirect()->route('task.show',[$taskId]);
            }
        }
        if($taskStatus == 'STOPPED'){
            
            if(!empty($lastTaskStatus) && in_array($lastTaskStatus->status,['START'])){
                $tm = new TaskMeta() ;
                $tm->task_id = $taskId;
                $tm->status = $taskStatus;
                $tm->claimBy = $lastTaskStatus->claimBy;
                $tm->remarks = $_POST['remarks'];
                if($tm->save()){

                    $tt = TaskTrack::where(['task_meta_id_start'=>$lastTaskStatus->id])->orderBy('id','desc')->first();
                    $tt->task_meta_id_end = $tm->id;
                    $tt->end_time = date("Y-m-d h:i:s");
                    $tt->save();

                    foreach($request->file('files') as $key => $file)
                    {
                        $path = $file->store($task->id,'taskAttachments');
                        $ta = New TaskAttachements();
                        $ta->task_id = $task->id;
                        // dd($request->file('files')[$index]);
                        $ta->task_attachment_url =  $path;
                        $ta->task_meta_id =  $tm->id;
                        $ta->filename = $file->getClientOriginalName();
                        $ta->save();

                    }

                    DB::commit();
                    Toastr::success('Task stopped :)','Success');
                    return redirect()->route('task.show',[$taskId]); 
                }else{
                    DB::rollback();
                    Toastr::error('Something went wrong :(','Error');
                    return redirect()->route('task.show',[$taskId]); 
                }

            }else{
                DB::rollback();
                Toastr::error('Only start task can be stopped :(','Error');
                return redirect()->route('task.show',[$taskId]);
            }
        }

        if($taskStatus == 'COMPLETE'){
            
            if(!empty($taskStatus) && in_array($lastTaskStatus->status,['START','STOPPED'])){
                $tm = new TaskMeta() ;
                $tm->task_id = $taskId;
                $tm->status = $taskStatus;
                $tm->claimBy = $lastTaskStatus->claimBy;
                $tm->remarks = $_POST['remarks'];
                if($tm->save()){
                    $tt = TaskTrack::where(['task_meta_id_start'=>$lastTaskStatus->id])->orWhere(['task_meta_id_end'=>$lastTaskStatus->id])->orderBy('id','desc')->first();
                    
                    if(empty($tt->task_meta_id_end)){

                        $tt->task_meta_id_end = $tm->id;
                        $tt->end_time = date("Y-m-d h:i:s");
                        $tt->save();
                    }else{
                        $ntt =  new TaskTrack();
                        $ntt->task_id = $taskId;
                        $ntt->task_meta_id_start = $tm->id;
                        $ntt->start_time = date("Y-m-d h:i:s");
                        $ntt->task_meta_id_end = $tm->id;
                        $ntt->end_time = date("Y-m-d h:i:s");
                        $ntt->save();
                    }

                    foreach($request->file('files') as $key => $file)
                    {
                        $path = $file->store($task->id,'taskAttachments');
                        $ta = New TaskAttachements();
                        $ta->task_id = $task->id;
                        // dd($request->file('files')[$index]);
                        $ta->task_attachment_url =  $path;
                        $ta->task_meta_id =  $tm->id;
                        $ta->filename = $file->getClientOriginalName();
                        $ta->save();

                    }
                    DB::commit();
                    Toastr::success('Task completed :)','Success');
                    return redirect()->route('task.show',[$taskId]); 
                }else{
                    DB::rollback();
                    Toastr::error('Something went wrong :(','Error');
                    return redirect()->route('task.show',[$taskId]); 
                }

            }else{
                DB::rollback();
                Toastr::error('Only start task can be completed :(','Error');
                return redirect()->route('task.show',[$taskId]);
            }
        }

        if($taskStatus == 'UPDATES'){
            
            $tm = new TaskMeta() ;
            $tm->task_id = $taskId;
            $tm->status = $lastTaskStatus->status;
            $tm->claimBy = $lastTaskStatus->claimBy;
            $tm->remarks = "UPDATES : ".$_POST['remarks'];
            if($tm->save()){
              
                if($lastTaskStatus->status == 'START'){

                    $tt = TaskTrack::where(['task_meta_id_start'=>$lastTaskStatus->id])->orderBy('id','desc')->first();
                    $tt->task_meta_id_end = $tm->id;
                    $tt->end_time = date("Y-m-d h:i:s");
                    $tt->save();

                    $tt = new TaskTrack();
                    $tt->task_id = $taskId;
                    $tt->task_meta_id_start = $tm->id;
                    $tt->start_time = date("Y-m-d h:i:s");
                    $tt->save();
                }
                
                foreach($request->file('files') as $key => $file)
                {
                    $path = $file->store($task->id,'taskAttachments');
                    $ta = New TaskAttachements();
                    $ta->task_id = $task->id;
                    // dd($request->file('files')[$index]);
                    $ta->task_attachment_url =  $path;
                    $ta->task_meta_id =  $tm->id;
                    $ta->filename = $file->getClientOriginalName();
                    $ta->save();

                }

                DB::commit();

                Toastr::success('Task Updated :)','Success');
                return redirect()->route('task.show',[$taskId]); 
            }else{
                DB::rollback();
                Toastr::error('Something went wrong :(','Error');
                return redirect()->route('task.show',[$taskId]); 
            }
            
        }
    }
}
