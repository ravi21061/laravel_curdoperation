<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id','DESC')->paginate(5);
        return view('employee.list',['employees'=>$employees]);
    }

    public function create()
    {
        return view('employee.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'image' => 'sometimes|image:jpg,jpeg,png,gif',
        ]);
        if($validator->passes()){
                    $employee = new Employee();
                    $employee->name=$request->name;
                    //$employee-> name = $request->name;
                    $employee-> email = $request->email;
                    $employee-> address = $request->address;
                    $employee-> save();
                    $request->session()->flash('success','Employee added successfully');
        } 
        if($request->image){
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->image->move(public_path().'/uploads/employees',$newFileName);
            $employee->image=$newFileName;
            $employee->save();
        }

        else{
            return redirect()->route('employees.create')->withErrors($validator)->withInput();

        }
    }
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit',['employee'=>$employee]);
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:jpg,jpeg,png,gif',
    ]);
    if($validator->passes()){
                $employee =  Employee::find($id);
                $employee->name=$request->name;
                //$employee-> name = $request->name;
                $employee-> email = $request->email;
                $employee-> address = $request->address;
                $employee-> save();
                // $request->session()->flash('success','Employee added successfully');
                
     
    // return redirect()->route('employees.index');

    // Upload Image Here
    if($request->image){
        $oldImage = $employee->image;
        $ext = $request->image->getClientOriginalExtension();
        $newFileName = time().'.'.$ext;
        $request->image->move(public_path().'/uploads/employees/',$newFileName);
        $employee->image=$newFileName;
        $employee->save();

        File::delete(public_path().'/uploads/employees/'.$oldImage);
        //Redirect page to index
        // return redirect()->route('employees.index');
        
    }
   
    return redirect()->route('employees.index');
    
 } else{
        // Return with errors
        return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
 
    }
    }
}
