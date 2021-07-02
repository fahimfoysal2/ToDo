<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\View\View;

class TodoController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('editTodo', compact('todo'));
    }
}
