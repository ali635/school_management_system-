<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use Validator;
use App\Http\Resources\Grade as GradeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class GradeController extends BaseController
{
    /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $Grades = Grade::all();
      return $this->sendResponse(GradeResource::collection($Grades),
          'All Grades sent');
  }
  
  public function store(Request  $request)
  {
    $input = $request->all();
    $validator = Validator::make($input , [
        'Name' => 'required',
    ]);
    if ($validator->fails()) 
    {
        return $this->sendError('Please validate error' ,$validator->errors() );
    }
    $Grade = new Grade();
    $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
    $Grade->Notes = $request->Notes;
    $Grade->save();
    return $this->sendResponse(new GradeResource($Grade) ,'Grade created successfully' );
  }

  public function show($id)
    {
        $Grade = Grade::findOrFail($id);
        if ( is_null($Grade) ) {
            return $this->sendError('Grade not found'  );
              }
              return $this->sendResponse(new GradeResource($Grade) ,'Grade found successfully' );

    }
    public function update($id,StoreGrades $request)
    {
        $input = $request->all();
        $validator = Validator::make($input , [
            'Name' => 'required',
        ]);
        if ($validator->fails()) 
        {
            return $this->sendError('Please validate error' ,$validator->errors() );
        }
        $Grade = Grade::findOrFail($id);
        $Grade->update([
            $Grade->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
            $Grade->Notes = $request->Notes,
        ]);
        return $this->sendResponse(new GradeResource($Grade)  ,'Product updated successfully' );
    }
    public function destroy($id)
    {

        $Grades = Grade::findOrFail($id);
        if ($Grades != null) {
            $Grades->delete();
            return $this->sendResponse(new GradeResource($Grades)  ,'Product deleted successfully' );
        }
        else {
            return $this->sendError('Grade not found');
        }

    }
}
