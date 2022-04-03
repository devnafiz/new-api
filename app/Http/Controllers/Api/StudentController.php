<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
      public function register(Request $request){

             $validateData =$request->validate([

             'name'=>'required',
             'email'=>'required|email|unique:students',
             'phone_no'=>'required',
             'password' =>'required',
             

         ]);

             $student =new Student();
             $student->name=$request->name;
             $student->email=$request->email;
             $student->phone_no=$request->phone_no;
             $student->password= Hash::make($request->password);
             $student->save();

             return response()->json([

                  'status'=>'1',
                  'message'=>'insert Successfully'

             ],200);

      }

      public function login(Request $request){

        $validateData=$request->validate([
            'email'=>'required|email',
            'password' =>'required',

        ]);

        $student =Student::where('email',$request->email)->first();

        if (isset($student->id)) {
              if(Hash::check($request->password,$student->password)){


                //create token

                $token =$student->createToken("auth_token")->plainTextToken;
                //send to response

                return response()->json([

                       'status'=>1,
                       'message'=>'Logged in Successfully',
                       'access_token'=> $token
                ]);


              }else{

                    return response()->json([

                    'status'=>'0',
                    'message'=>'Student password not match'

                ],);
              }

            // code...
        }else{

            return response()->json([

                'status'=>'0',
                'message'=>'Student not found'

            ],404);
        }


      }

      public function profile($id){


      }

      public function logout($id){


      }
}
