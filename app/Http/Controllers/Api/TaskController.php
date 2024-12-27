<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource; 

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("view task");
        $Data = Task::latest()->paginate(5);
        return new TaskResource($status=TRUE, "data task", $Data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create task");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize("view task");
        $show = Task::find($id);
        return new TaskResource($status=FALSE, "data gaming", $show);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize("edit task");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize("destroy task");
        $del = Task::find($id);
        $del->delete();

        return new TaskResource($status=TRUE, "menghilanglah", $del);
    }
}
