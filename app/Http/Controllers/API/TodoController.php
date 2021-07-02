<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Repositories\TodoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;

        $todos = $this->repository->where('user_id', $user_id)->get();

//        $todos = Todo::where('user_id', $user_id)->get();
        return response()->json(['message' => "Retrieved successfully", 'todos' => $todos]);
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
        $todo_id = $this->repository->create(["user_id" => $user_id, "data" => $request->data])->id;
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
    public function update(Request $request, $todo_id)
    {
        try {
            $todo = Todo::findOrFail($todo_id);
            if ($todo->user->is($request->user())) {
                $todo->data = $request->data;
                $saved = $todo->save();
                return response()->json([$saved ? "Data Updated" : "Update Failed"]);
            }
            return response()->json(["message" => "Not authorized"], 401);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Not found!"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function destroy(Request $request, $todo_id)
    {
        try {
            $todo = Todo::findOrFail($todo_id);
            if ($todo->user->is($request->user())) {
                $todo->delete();
                return response()->json(["message" => "Todo Deleted"]);
            }
            return response()->json(["message" => "Not authorized"], 401);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Not found!"], 400);
        }
    }
}
