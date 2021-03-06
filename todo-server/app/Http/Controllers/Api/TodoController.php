<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todo;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return TodoResource::collection(Todo::all()->where('compFlag', 0));
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Todo::create($request->all());
      return redirect('api/todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return new TodoResource(Todo::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $todo = Todo::find($id);
      $todo -> update($request->all());
      return redirect("api/todo/".$id);
    }

    public function deleteData(Request $request)
    {
      $todo = Todo::find($request->input('id'));
      $todo->delete();
    }
}
