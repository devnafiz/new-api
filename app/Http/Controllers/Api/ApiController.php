<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class ApiController extends Controller
{
     public function createEmployee(Request $request){

         $validateData =$request->validate([

             'name'=>'required',
             'email'=>'required|email|unique:employees',
             'phone_no'=>'required',
             'gender' =>'required',
             'age' =>'required'

         ]);

         $employee = new Employee();
         $employee->name =$request->name;
         $employee->email =$request->email;
          $employee->phone_no =$request->phone_no;

          $employee->gender =$request->gender;
          $employee->age =$request->age;
          $employee->save();
          return response()->json([

           "status" => 1,
           'message' =>'Employee created sucessfully'

          ]);

     }

     public function ListEmployees(){

     }


     public function getSingleEmployee($id){

     }

     public function updateEmployee(Request $request, $id){


     }

     public function deleteEmployee($id){



     }
}
