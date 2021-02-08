<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use App\Models\Classroom;
use Validator;
use App\Http\Resources\Class_room as ClassResource;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class ClassroomController extends BaseController
{
    /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $My_Classes = Classroom::all();
      return $this->sendResponse(ClassResource::collection($My_Classes),
          'All Grades sent');
  }
  
  public function store(Request  $request)
  {
    $input = $request->all();
    $validator = Validator::make($input , [
        'Name_Class' => 'required',
        'Name_class_en' => 'required',
        'Grade_id'=>'required'
    ]);
    if ($validator->fails()) 
    {
        return $this->sendError('Please validate error' ,$validator->errors() );
    }
    $Class = new Classroom();
    $Class->Name_Class = ['en' => $request->Name_class_en, 'ar' => $request->Name_Class];
    $Class->Grade_id = $request->Grade_id;
    $Class->save();
    return $this->sendResponse(new ClassResource($Class) ,'class created successfully' );
  }

  public function show($id)
    {
        $Class = Classroom::find($id);
        if ( is_null($Class) ) {
            return $this->sendError('Grade not found'  );
              }
              return $this->sendResponse(new ClassResource($Class) ,'class found successfully' );

    }
    public function update($id,Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input , [
            'Name_Class' => 'required',
            'Name_class_en' => 'required',
            'Grade_id'=>'required'
        ]);
        if ($validator->fails()) 
        {
            return $this->sendError('Please validate error' ,$validator->errors() );
        }
        $Class = Classroom::find($id);
        $Class->update([
            $Class->Name_Class = ['ar' => $request->Name_Class, 'en' => $request->Name_class_en],
            $Class->Grade_id = $request->Grade_id,
        ]);
        return $this->sendResponse(new ClassResource($Class)  ,'class updated successfully' );
    }

    public function destroy($id)
    {
        $Class = Classroom::find($id);
        if ($Class != null) {
            $Class->delete();
            return $this->sendResponse(new ClassResource($Class)  ,'class deleted successfully' );
        }
        else{
            return $this->sendError('Class not found');
        }
    }
}
