<?php

namespace App\Http\Controllers;

use App\Models\TaskAttachements;
use App\Http\Requests\StoreTaskAttachementsRequest;
use App\Http\Requests\UpdateTaskAttachementsRequest;

class TaskAttachementsController extends Controller
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
     * @param  \App\Http\Requests\StoreTaskAttachementsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskAttachementsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskAttachements  $taskAttachements
     * @return \Illuminate\Http\Response
     */
    public function show(TaskAttachements $taskAttachements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskAttachements  $taskAttachements
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskAttachements $taskAttachements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskAttachementsRequest  $request
     * @param  \App\Models\TaskAttachements  $taskAttachements
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskAttachementsRequest $request, TaskAttachements $taskAttachements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskAttachements  $taskAttachements
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskAttachements $taskAttachements)
    {
        //
    }
}
