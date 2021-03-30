<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Http\Resources\Section as SectionResource;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Section;

class SectionController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Sections = Section::with(['Grades'])->get();
      return $this->sendResponse(SectionResource::collection($Sections),
          'All Sections sent');
  }
  
  public function store(Request  $request)
  {
    $input = $request->all();
    $validator = Validator::make($input , [
        'Name_Section_Ar' => 'required',
        'Name_Section_En' => 'required',
        'Status'=>'required|numeric',
        'Grade_id'=>'required|numeric',
        'Class_id'=>'required|numeric',
        'teacher_id'=>'required|numeric',
    ]);
    if ($validator->fails()) 
    {
        return $this->sendError('Please validate error' ,$validator->errors() );
    }
    $Section = new Section();
    $Section->Name_Section = ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar];
    $Section->Status = $request->Status;
    $Section->Grade_id = $request->Grade_id;
    $Section->Class_id = $request->Class_id;
    $Section->save();
    $Section->teachers()->attach($request->teacher_id);
    return $this->sendResponse(new SectionResource($Section) ,'Section created successfully' );
  }

  public function show($id)
    {
        $Section = Section::findOrFail($id);
        if ( is_null($Section) ) {
            return $this->sendError('Section not found'  );
              }
              return $this->sendResponse(new SectionResource($Section) ,'Section found successfully' );

    }
    public function update($id,Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input , [
            'Name_Section_Ar' => 'required',
            'Name_Section_En' => 'required',
            'Status'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required'
        ]);
        if ($validator->fails()) 
        {
            return $this->sendError('Please validate error' ,$validator->errors() );
        }
        $Section = Section::findOrFail($id);
        $Section->update([
            $Section->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
            $Section->Status = $request->Status,
            $Section->Grade_id = $request->Grade_id,
            $Section->Class_id = $request->Class_id,
        ]);
        return $this->sendResponse(new SectionResource($Section)  ,'Section updated successfully' );
    }

    public function destroy($id)
    {
        $Section = Section::findOrFail($id);
        if ($Section != null) {
            $Section->delete();
            return $this->sendResponse(new SectionResource($Section)  ,'Section deleted successfully' );
        }
        else{
            return $this->sendError('Section not found');
        }
    }
}