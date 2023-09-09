<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Intake;
use App\Models\Models\Batch;
use App\Models\BatchApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $batches = Batch::paginate(10);

       if(auth()->user()->role==3)
       {
            $data['batches']=DB::table('batches')
            ->select('batches.id','batches.name','batches.year','batches.description','intakes.name as department','batches.old_file_name')   
            ->join('intakes', 'batches.intake_id', '=', 'intakes.id') 
            ->paginate(15);

            $data['intakes']=DB::table('intakes')
            ->select('intakes.id as deptid','intakes.name as deptname' ) 
            ->get();
       
        }
       else
        { $data['batches']=DB::table('batches')
            ->select('batches.id','batches.name','batches.year','batches.description','intakes.name as department','batches.old_file_name')    
            ->join('intakes', 'batches.intake_id', '=', 'intakes.id') 
            ->join('participants', 'batches.intake_id', '=', 'participants.intake_id')
            ->where('participants.id','=', auth()->user()->id)
            ->paginate(15);

        $data['intakes']=DB::table('intakes')
            ->select('intakes.id as deptid','intakes.name as deptname' ) 
            ->join('participants', 'intakes.id', '=', 'participants.intake_id')              
            ->where('participants.id','=', auth()->user()->id)
            ->get();
       }

 
        $data['subjectList']=DB::table('participants')
        ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
        ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
        ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
        ->where('participants.is_flow','=', 1)
        ->get();
         
        return view('pages.batch.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    
    {
        // $token = csrf_token();
        // dd($token);
        //dd($request->all());
        //$url = $request->url();

       // $ip = $request->ip();

        //dd($ip);

        $batch = new Batch();
        $batch->name = $request->batch_name;     
        $batch->description = $request->batch_description;
        $batch->intake_id = $request->intake_id;
        $batch->created_by=auth()->user()->id;

        $dept_pre_fix=DB::table('intakes')
        ->select('intakes.dept_prefix')
        ->where('intakes.id','=', $request->intake_id)
        ->first();
      
        $maxValue = DB::table('batches')->where('batches.intake_id','=', $request->intake_id)->max('file_no');


        if($maxValue!='')
        {$maxValue=$maxValue+1;}
        
        else 
        {
            $maxValue = DB::table('intakes')->where('intakes.id','=', $request->intake_id)->max('sl_no');

            if($maxValue=='')
            {
                $maxValue=$maxValue+1;

            }

        }
        
        // $maxValue=$maxValue+1;
        
        $prefix=$dept_pre_fix->dept_prefix;        
        $fileno=$prefix. $maxValue;      
        $batch->year =$fileno ;
        $batch->file_no =$maxValue ;

        if($request->file('file')!='')
        {

        $request->validate(['file' => 'required|mimes:pdf|max:20480']);
        if($request->file()) {
            

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->move(public_path('images'), $fileName);
            $batch->old_file_name = time().'_'.$request->file->getClientOriginalName();    
            $batch->old_file_path = $filePath;
        
         }

        }

        $batch->save();


        for ($i = 0; $i < sizeof($request->subject); $i++) {
            $subject = new BatchApproval();
            $subject->batch_id = $batch->id;
            $subject->participant_id = $request->subject[$i];
            $subject->save();
        }

        return back()->with('success','Data has been saved.');
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

    

        $data['batch']=DB::table('batches')
        ->select('batches.id','batches.name','batches.year','batches.description','batches.old_file_name')     
        ->where('batches.id','=', $id)
        ->first();
      
        $data['subjectList']=DB::table('participants')
        ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
        ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
        ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
        ->where('participants.is_flow','=', 1)
        ->get();

        $data['approvallist']=DB::table('batch_wise_approval')
        ->select('batch_wise_approval.batch_id','batch_wise_approval.participant_id','participants.name')
        ->join('batches', 'batch_wise_approval.batch_id', '=', 'batches.id')
        ->join('participants', 'batch_wise_approval.participant_id', '=', 'participants.id')
        ->where('batches.id','=', $id)
        ->get();

        

        return view('pages.batch.edit',$data);

       
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
        $batch = Batch::find($id);
        $batch->name = $request->batch_name;
        $batch->year = $request->batch_year;
        $batch->description = $request->batch_description;

        if($request->file('file')!='')
        {

        $request->validate(['file' => 'required|mimes:pdf|max:20480']);
        if($request->file()) {
            

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->move(public_path('images'), $fileName);
            $batch->old_file_name = time().'_'.$request->file->getClientOriginalName();    
            $batch->old_file_path = $filePath;
        
         }

        }

       
        $batch->save();

        $count=sizeof($request->subject);
        
       if($count>1)
        
        { DB::table('batch_wise_approval')->where('batch_id', '=', $id)->delete();
          for ($i = 0; $i < sizeof($request->subject); $i++) {
            $subject = new BatchApproval();
            $subject->batch_id = $batch->id;
            $subject->participant_id = $request->subject[$i];
            $subject->save();
            }
       
        }

        return Redirect()->route('batch.index')->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $batch = Batch::find($id);
        if (!is_null($batch)) {
            DB::table('batch_wise_approval')->where('batch_id', '=', $id)->delete();
        
            $batch->delete();
        }
        return back()->with('success','Data has been deleted.');
    }


    public function getallfiles(Request $request)

    {
        $header=$request->header('Authorization');
        if($header=='')

        {
            return Response()->json(['message'=>'Authorization is required'],422);

        }
        else
        {
            if($header=='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6ImFjcCIsImlhdCI6MTUxNjIzOTAyMn0.0s6cMmARtVWMh35iiQ23vMvzi0x-CCFhBctb2YmF_YE')
            {
                return Response()->json(Batch::all(), 200);
            }
            else{

                return Response()->json(['message'=>'Authorization dose not match'],422);
            }

        }

       
       
       
    }

    
    public function getfilesbyid($id)

    {
        $file = Batch::find($id);

        if(is_null($file))
         {
            return Response()->json(['message'=>'file not found'],404);

         }
    
         return Response()->json( $file, 200);

    }

    public function addfiles(Request $request)

    {
        $file = Batch::create($request->all());

        return Response()->json($file , 201);

    
    }

    public function updatefiles(Request $request,$id)

    {

        $file = Batch::find($id);

        if(is_null($file))
        {
           return Response()->json(['message'=>'file not found'],404);

        }

        $file->update($request->all());

        return Response()->json($file , 200);


    }
    public function deletefiles(Request $request,$id)

    {
        $file = Batch::find($id);

        if(is_null($file))
        {
           return Response()->json(['message'=>'file not found'],404);

        }
        $file->delete();

        return Response('file deleted ', 200);

    }

}
