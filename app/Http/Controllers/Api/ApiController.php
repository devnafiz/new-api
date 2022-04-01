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
           $employees=Employee::all();

           return response()->json([
                   "status" => 1,
           'message' =>'Employee created sucessfully',
           'data'=>$employees

           ],200);
     }


     public function getSingleEmployee($id){

          if(Employee::where('id',$id)->exists()){
               $employee_details =Employee::where('id',$id)->first();

               return response()->json([
                     'status'=>'1',
                      'message'=>'Employee is here',
                      'data'=> $employee_details 
               ]);

          }else{

               return response()->json([
                      'status'=>'0',
                      'message'=>'Employee not found'
               ],404);
          }

     }

     public function updateEmployee(Request $request, $id){

             if(Employee::where('id',$id)->exists()){

                $data= Employee::find($id);

                $data->name =$request->name;
                $data->email=$request->email;
                $data->phone_no =$request->phone_no;
                $data->gender =$request->gender;
                $data->age = $request->age;
                $data->save();

                return response()->json([

                  "status" => 1,
                  "message" => "Employee updated successfully"
                ]);


             }else{

               return response()->json([
                    'status'=>'0',
                    'message'=>'no update'
               ],404);
             }
     }

     public function deleteEmployee($id){

              if (Employee::where("id", $id)->exists()) {

            $employee = Employee::find($id);

            $employee->delete();

            return response()->json([
                "status" => 1,
                "message" => "Employee deleted successfully"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found"
            ], 404);
        }
    }

     
}
