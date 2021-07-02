<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $todos = Todo::all();
        return response()->json(['todos' => $todos, 'message' => 'Retrieved successfully']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            "data" => "required"
        ]);

        $user_id = $request->user()->id;
        $todo_id = Todo::create(["user_id" => $user_id, "data" => $request->data])->id;
        return response()->json($todo_id);
    }

    /**
     * Display the specified resource.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function show(Todo $todo)
    {
        return response()->json("Hello Alien");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Todo $todo
     * @return JsonResponse
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->data = $request->data;
        $saved = $todo->save();
        return response()->json($saved ? "Data Updated" : "Update Failed");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function destroy(Todo $todo)
    {
        $deleted = $todo->delete();
        return response()->json($deleted ? "Data Deleted" : "Delete Failed");
    }
}
