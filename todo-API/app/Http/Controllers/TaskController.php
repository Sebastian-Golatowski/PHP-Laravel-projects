<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    private function getData(){
        $user_id = Auth::guard()->id();
        $tasks = Task::where('user_id',$user_id)->get();
        
        return $tasks;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return response($this->getData(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::guard()->id();

        $request->validate([
            'text'=>'required',
        ]);
        
        $task= new Task();
        $task->user_id = $user_id;
        $task->text = $request->text;
        $task->day = $request->day;
        $task->reminder = $request->reminder;
        $task->save();


        return response($this->getData(),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $task = Task::find($id);

        $task->reminder = !$task->reminder;
        $task->save();

        return response(null,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
    }


}
