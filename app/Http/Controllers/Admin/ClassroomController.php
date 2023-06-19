<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get classrooms
        $classrooms = Classroom::when(request()->q, function($classrooms) {
            $classrooms = $classrooms->where('title', 'like', '%' . request()->q . '%');
        })->latest()->paginate(8);

        $classrooms->appends(['q' => request()->q]);

        return inertia('Admin/Classrooms/Index', [
            'classrooms' => $classrooms,
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:classrooms'
        ]);

        //create classroom
        Classroom::create([
            'title' => $request->title,
        ]);

        //return redirect 
        return redirect()->route('admin.classrooms.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);

        return inertia('Admin/Classrooms/Edit',[
            'classroom' => $classroom,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'title' => 'required|string|unique:classrooms,title,'.$classroom->id,
        ]);

        //create classroom
        $classroom->update([
            'title' => $request->title,
        ]);

        //return redirect 
        return redirect()->route('admin.classrooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::FindOrFail($id);

        $classroom->delete();
        
        return redirect()->route('admin.classrooms.index');
    }
}
