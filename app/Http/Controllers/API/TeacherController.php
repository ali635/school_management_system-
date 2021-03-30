<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Http\Resources\Teacher as TeacherResource;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherController extends BaseController
{
    /**
 * Display a listing of the resource.
 *
 * @return Response
 */
  public function index()
  {
    $teachers = Teacher::all();
      return $this->sendResponse(TeacherResource::collection($teachers),
          'All Teachers sent');
  }

  public function store(Request  $request)
  {
    $input = $request->all();
    $validator = Validator::make($input , [
        'Email' => 'required|email|unique:teachers,Email',
        'Password' => 'required',
        'Name_ar' => 'required',
        'Name_en' => 'required',
        'Specialization_id' => 'required',
        'Gender_id' => 'required',
        'Joining_Date' => 'required|date|date_format:Y-m-d',
        'Address' => 'required',
    ]);
    if ($validator->fails()) 
    {
        return $this->sendError('Please validate error' ,$validator->errors() );
    }
    $Teachers = new Teacher();
    $Teachers->Email = $request->Email;
    $Teachers->Password =  Hash::make($request->Password);
    $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
    $Teachers->Specialization_id = $request->Specialization_id;
    $Teachers->Gender_id = $request->Gender_id;
    $Teachers->Joining_Date = $request->Joining_Date;
    $Teachers->Address = $request->Address;
    $Teachers->save();
    return $this->sendResponse(new TeacherResource($Teachers) ,'Teacher created successfully' );
  }

  public function show($id)
  {
      $teacher = Teacher::find($id);
      if ( is_null($teacher) ) {
          return $this->sendError('teacher not found');
            }
            return $this->sendResponse(new TeacherResource($teacher) ,'teacher found successfully' );
  }

  public function update($id,Request $request)
  {
      $input = $request->all();
      $validator = Validator::make($input , [
        'Email' => 'required|email',
        'Password' => 'required',
        'Name_ar' => 'required',
        'Name_en' => 'required',
        'Gender_id' => 'required',
        'Specialization_id' => 'required',
        'Joining_Date' => 'required|date|date_format:Y-m-d',
        'Address' => 'required',
      ]);
      if ($validator->fails()) 
      {
          return $this->sendError('Please validate error' ,$validator->errors() );
      }
      $Teacher = Teacher::findOrFail($id);
      
      $Teacher->Email = $request->Email;
      $Teacher->Password =  Hash::make($request->Password);
      $Teacher->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
      $Teacher->Specialization_id = $request->Specialization_id;
      $Teacher->Gender_id = $request->Gender_id;
      $Teacher->Joining_Date = $request->Joining_Date;
      $Teacher->Address = $request->Address;
      $Teacher->save();
      return $this->sendResponse(new TeacherResource($Teacher)  ,'Teacher updated successfully' );
  }

  public function destroy($id)
  {
      $Teacher = Teacher::findOrFail($id);
      if ($Teacher != null) {
          $Teacher->delete();
          return $this->sendResponse(new TeacherResource($Teacher)  ,'Teacher deleted successfully' );
      }
      else{
          return $this->sendError('Teacher not found');
      }
  }
}