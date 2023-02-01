<?php

namespace App\Http\Controllers;

use App\Models\TaskMeta;
use App\Http\Requests\StoreTaskMetaRequest;
use App\Http\Requests\UpdateTaskMetaRequest;

class TaskMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTaskMetaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskMetaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskMeta  $taskMeta
     * @return \Illuminate\Http\Response
     */
    public function show(TaskMeta $taskMeta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskMeta  $taskMeta
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskMeta $taskMeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskMetaRequest  $request
     * @param  \App\Models\TaskMeta  $taskMeta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskMetaRequest $request, TaskMeta $taskMeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskMeta  $taskMeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskMeta $taskMeta)
    {
        //
    }
}
