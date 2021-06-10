<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function employees(){

        $employees = Employee::all();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $employees
        ]);
    }

    public function departments(){
        
        $departments = Employee::with('department')->get();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $departments
        ]);
    }

    Public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'id_department' => 'required',
        ]);

        $name = $request->name;
        $telephone = $request->telephone;
        $email = $request->email;
        $id_department = $request->id_department;


        $post = Employee::create([
            'name' => $name,
            'telephone' => $telephone,
            'email' => $email,
            'id_department' => $id_department,
        ]);

        if ($post) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $data
            ]);
        }else {
            return response()->json([
                'status' => 400,
                'message' => 'failed'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'id_department' => 'required',
        ]);

        $post = Employee::find($id)->update($request->all());
    
        if ($post) {
            return response()->json([
                'success' => 200,
                'message' => 'success',
                'data' => $post
            ], 201);
        } else {
            return response()->json([
                'success' => 400,
                'message' => 'failed',
            ], 400);
        }
    }

    public function destroy(Request $request, $id)
    {
        $post = Employee::find($id)->delete();
        
        if ($post) {
            return response()->json([
                'success' => 200,
                'message' => 'success',
                'data' => $post
            ], 201);
        } else {
            return response()->json([
                'success' => 400,
                'message' => 'failed',
            ], 400);
        }
    }
}
