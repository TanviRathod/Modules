<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $projectList = Project::all();
        return view('Student.index',compact('projectList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Student.create');
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
        'name'=>"required|max:50|min:5",
        'age'=>"required|before:-25 years",//|between:20,25
        'profile'=>"required|mimes:jpg,png,jpeg",//|size:2048
        'gender'=>"required",
        'hobby'=>"required",
        'country'=>"required",
       ]);

       $student= new Student();
       $student->name=$request->name;
       $student->age=$request->age;
       $profile = $request->profile->getClientOriginalName();  
       $request->profile->move(public_path('images'), $profile);
       $student->profile=$profile;
       $student->gender= $request->gender;
       $student->hobby=json_encode($request->hobby);
       $student->country=$request->country;
       $student->save();
       return redirect()->route('student.index');
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
        $student_id=Student::findOrFail($id);
        return view('Student.edit',compact('student_id'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'name'=>"required|max:50|min:5",
            'age'=>"required",
            'gender'=>"required",
            'hobby'=>"required",
            'country'=>"required",
           ]);
    
           $student= Student::find($id);
           $student->name=$request->name;
           $student->age=$request->age;
         
           if ($request->file('profile')) {
         
            $profile = $request->profile->getClientOriginalName();  
            $request->profile->move(public_path('images'), $profile);
            $student->profile=$profile;
            }else{
               
                unset($request->profile);
            }
           $student->gender= $request->gender;
           $student->hobby=json_encode($request->hobby);
           $student->country=$request->country;
        
           $student->update();
           return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_id=Student::find($id)->delete();
        return redirect()->back();
    }
    public function delete(Request $request)
    {
       
        $student_id=Student::find($request->id)->delete();
        return response()->json(['status'=>"true"]);
    }

    public function getdata(Request $request)
    {
        if ($request->ajax()) {
         
            $data = Student::all();                                                                                                 
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('profile', function($row){
                        $url= asset('images/'.$row->profile);
                        $image = '<img src="'.$url.'" width="30px">';
                         return $image;
                    })
                    ->addColumn('hobby',function($row){
                         return json_decode($row->hobby);
                    })
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="'.route('student.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                           $btn .= '<a href="" data-id="'.$row->id.'" class="btn btn-danger btn-sm ml-2 delete_button">Delete</a>';
                           $btn .= '<a href="" data-id="'.$row->id.'" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#exampleModal" onclick=openModel('.$row->id.')>Add Project</a>';
                           return $btn;
                    })
                    ->rawColumns(['action','profile'])
                    ->make(true);
        }


        
        return view('Student.index');
    }

    public function FilterData(Request $request,$cityFilterId)
    {
        $CityFilter = $request->cityFilterId ? ($cityFilterId) : 0 ;
        $studentList= Student::where('country',$cityFilterId)->first();
      
      
        if(!empty($CityFilter))
        {
            Cookie::queue('CityFilter',$cityFilterId);
            $studentList= Student::where('country',$cityFilterId)->first();
        }
           
        $value =Cookie::get('CityFilter');
        if(!empty($value))
        {
               
            if(!empty($CityFilter))
            {
                $studentList= Student::where('country',$CityFilter)->first();
            }
            else
            {
                $studentList= Student::where('country',$value)->first();
            }
        }

        return $studentList;
       
    }

    public function getdeveloper(Request $request)
    {
        $developer = Developer::where('project_id',$request->projectId)->get();
        return response()->json([   
            "developer"=>$developer
        ]);
    }

    public function editmodel()
    {
        
    }
}
//
//  coukumn name lakho where ma
// ek project ek rakhi baki multipal select karvanu
//find karcanu ke get? id match thay a lay jav chu / to developer multiple nai hoy hoy ne
