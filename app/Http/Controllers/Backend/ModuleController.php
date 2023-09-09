<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Models\Batch;
use App\Models\Module;
use App\Models\ModuleWiseCourse;
use App\Models\Subject;
use App\Models\Template;
use App\Models\Participant;
use App\Models\Country;
use App\Models\Intake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


// use \PDF;
use PDF;
use \setasign\Fpdi\Fpdi;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['moduleList'] = DB::table('modules')
        ->select('batches.name as filename', 'modules.batch_id','modules.name','modules.description', 'modules.id', 'modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status','modules.note_no'
        ,'modules.subnote','modules.isoldfile')
        ->join('batches', 'batches.id', '=', 'modules.batch_id')
        ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
        ->where('modules.created_by', '=', auth()->user()->id)
        ->paginate(15);
           
        // print_r( $data['moduleList']);
      //  exit;
          

      
        $modulewiseList = ModuleWiseCourse::get();
        //$batchList = Batch::get();

        $data['batchList'] = DB::table('batches')
            ->select('batches.id', 'batches.name', 'batches.intake_id')
            ->join('participants', 'batches.intake_id', '=', 'participants.intake_id')
            ->where('participants.id', '=', auth()->user()->id)
            ->get();

       // $templateslist = Template::get();


        $data['templateslist']=DB::table('templates')
        ->select('templates.id','templates.template_name','templates.template_details','templates.created_by')
        ->join('participants', 'templates.created_by', '=', 'participants.id')
        ->where('participants.intake_id','=', auth()->user()->intake_id)
        ->distinct()
        ->get();

        $data['subjectList'] = DB::table('participants')
            ->where('participants.is_flow', '=', 1)
            ->get();


        return view('pages.module.index', compact('modulewiseList'), $data);
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
    public function get_template_dtl_data(Request $request)
    {
        // $PresMedicine = PresMedicine::latest()->paginate(5);
        $TemplateDtls = Template::where('id', $request->id)->get();

        if (!is_null($TemplateDtls)) {
            return response()->json(["status" => "success", "message" => "Success! Template Dtls Found.", "data" => $TemplateDtls]);
        } else {
            return response()->json(["status" => "failed", "message" => "Alert! Template Dtls not Found"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $isoldfile = $request->oldfile;

        

       $maxValue = DB::table('modules')->where('modules.batch_id','=', $request->batch)->max('note_no');

        if($maxValue=='')
        {
            $maxValue=$maxValue+1;

        }
        else
        {
            $maxValue=$maxValue+1; 
        }

    
        $module = new Module();
        $module->name = $request->module_name;
		 $module->description = $request->desc;
        $module->batch_id = $request->batch;
        $module->month = $request->month;
        $module->note_status = $request->note_action;
        $module->created_by = auth()->user()->id;
        $module->note_no=$maxValue;
        $module->isoldfile=$isoldfile;

    if ($isoldfile==1)
   { $module->status='Approved';
   }

        if($request->file('file')==''){
            $module->file_name='test.pdf';
            $module->file_path='D:\xampp\htdocs\AFS\public\images\test.pdf';
            $module->save();

        }


        if($request->file('file')!='')

        {
            $request->validate(['file' => 'required|mimes:pdf|max:20480']);
            if ($request->file()) {

                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->move(public_path('images'), $fileName);
                $module->file_name = time() . '_' . $request->file->getClientOriginalName();
                $module->file_path = $filePath;

                $module->save();
            }
        } 
       
        $fileid = $request->batch;
        $data['approval'] = DB::table('batch_wise_approval')
            ->select('batch_wise_approval.batch_id', 'batch_wise_approval.participant_id')
            ->where('batch_wise_approval.batch_id', '=', $fileid)
            ->get();

  
  if ($isoldfile!=1)
    {
         

        $seq = 0;
        foreach ($data['approval'] as $object) {
            $subject = new ModuleWiseCourse();
            $subject->module_id = $module->id;
            $subject->subject_id = $object->participant_id;
            $seq = $seq + 1;
            $subject->seq = $seq;
            if($seq==1)
            {
                $subject->flag = 0;

            }
            $subject->save();
        }
    }
        return back()->with('success', 'Note  has been created.');
    }




    public function subnotecreate($id)
    {   

        $data['module']=DB::table('modules')
        ->select('modules.id','modules.name','modules.month','modules.batch_id','batches.name as filename','modules.file_name','modules.note_status','modules.note_no'
        ,'modules.subnote','modules.description')
        ->join('batches', 'modules.batch_id', '=', 'batches.id')
        ->where('modules.id','=', $id)
        ->first();
      // print_r($data['module']);
      // exit;


      $data['templateslist']=DB::table('templates')
      ->select('templates.id','templates.template_name','templates.template_details','templates.created_by')
      ->join('participants', 'templates.created_by', '=', 'participants.id')
      ->where('participants.intake_id','=', auth()->user()->intake_id)
      ->distinct()
      ->get();


      return view('pages.module.subnote', $data);

    }

    public function subnotestore(Request $request)
    {

        
         $maxValue = DB::table('modules')->where('modules.batch_id','=', $request->fileid)
        ->where('modules.note_no','=', $request->noteno)
        ->max('subnote');

        if($maxValue=='')
        {
            $maxValue=$maxValue+1;

        }
        else
        {
            $maxValue=$maxValue+1; 
        }


        $module = new Module();
        $module->name = $request->module_name;
		$module->description = $request->description;
        $module->batch_id = $request->fileid;
        $module->month = $request->month;
        $module->note_status = $request->note_action;
        $module->created_by = auth()->user()->id;
        $module->note_no=$request->noteno;
        $module->subnote=$maxValue;
        $module->moduleid=$request->moduleid;



        if($request->file('file')==''){
            $module->file_name='test.pdf';
            $module->file_path='D:\xampp\htdocs\AFS\public\images\test.pdf';
            $module->save();

        }


        if($request->file('file')!='')

        {
            $request->validate(['file' => 'required|mimes:pdf|max:20480']);
            if ($request->file()) {

                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->move(public_path('images'), $fileName);
                $module->file_name = time() . '_' . $request->file->getClientOriginalName();
                $module->file_path = $filePath;

                $module->save();
            }
        } 
    

        $fileid = $request->fileid;
        $data['approval'] = DB::table('batch_wise_approval')
            ->select('batch_wise_approval.batch_id', 'batch_wise_approval.participant_id')
            ->where('batch_wise_approval.batch_id', '=', $fileid)
            ->get();

        $seq = 0;
        foreach ($data['approval'] as $object) {
            $subject = new ModuleWiseCourse();
            $subject->module_id = $module->id;
            $subject->subject_id = $object->participant_id;
            $seq = $seq + 1;
            $subject->seq = $seq;
            if($seq==1)
            {
                $subject->flag = 0;

            }
            $subject->save();
        }

        return Redirect()->route('module.index')->with('success','sub note has been created.');
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
    public function editflow($id)
    {
       $data['approval']= ModuleWiseCourse::where('id','=',$id)
       ->first();

       $data['participant']=DB::table('participants')
       ->select('name')
       ->where('id', '=', $data['approval']->subject_id )
       ->first();

    
       $data['subjectList']=DB::table('participants')
       ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
       ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
       ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
       ->where('participants.is_flow','=', 1)
       ->get();
       return view('pages.module.editflow', $data);
       
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function approvalupdate(Request $request, $id)
    {
    
    // $moduleid=$request->moduleid;
   
    $module = ModuleWiseCourse::where('id','=',$id)
    ->where('module_wise_courses.flag','==', 0)
    ->first();
    
       $module->subject_id=$request->subject[0];
       $module->save();
       return Redirect()->route('note.list')->with('success','Data has been replaced.');

    }

    public function update(Request $request, $id)
    {
        $module = Module::find($id);

    //  print_r( $module->batch_id);
    //   exit;
if($module->status=='Rejected')

{
    $module->name = $request->module_name;
	 $module->description = $request->description;
    $module->month = $request->module_description;
    $module->note_status = $request->note_action;
    $module->status=null;
    $module->forwarded=null;
    $module->save();

    $data['approval'] = DB::table('batch_wise_approval')
    ->select('batch_wise_approval.batch_id', 'batch_wise_approval.participant_id')
    ->where('batch_wise_approval.batch_id', '=', $module->batch_id )
    ->get();

DB::table('module_wise_courses')->where('module_id', '=', $module->id )->delete();

$seq = 0;
foreach ($data['approval'] as $object) {
    $subject = new ModuleWiseCourse();
    $subject->module_id = $id;
    $subject->subject_id = $object->participant_id;
    $seq = $seq + 1;
    $subject->seq = $seq;
    if($seq==1)
            {
                $subject->flag = 0;

            }
    $subject->save();
}


    $request->validate(['file' => 'required|mimes:pdf|max:20480']);
        if ($request->file()) {
            $module = Module::find($id);
            // print_r($module);
            // exit;
            $module->name = $request->module_name;
			 $module->description = $request->description;
            $module->month = $request->module_description;
            $module->note_status = $request->note_action;
            $module->status=null;
            $module->forwarded=null;
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            // $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->file('file')->move(public_path('images'), $fileName);
            $module->file_name = time() . '_' . $request->file->getClientOriginalName();
            // $module->file_path = '/storage/' . $filePath;
            $module->file_path = $filePath;
            $module->save();
        }



        
        $data['approval'] = DB::table('batch_wise_approval')
            ->select('batch_wise_approval.batch_id', 'batch_wise_approval.participant_id')
            ->where('batch_wise_approval.batch_id', '=', $module->batch_id )
            ->get();

        DB::table('module_wise_courses')->where('module_id', '=', $module->id )->delete();

        $seq = 0;
        foreach ($data['approval'] as $object) {
            $subject = new ModuleWiseCourse();
            $subject->module_id = $id;
            $subject->subject_id = $object->participant_id;
            $seq = $seq + 1;
            $subject->seq = $seq;
            if($seq==1)
            {
                $subject->flag = 0;

            }
            $subject->save();
        }

    return back()->with('success', 'Data has been updated.');
}



        $module->name = $request->module_name;
        // $module->subject_id = $request->subject_id;
		 $module->description = $request->description;
        $module->month = $request->module_description;
        $module->note_status = $request->note_action;
        $module->save();

        $request->validate(['file' => 'required|mimes:jpg,png,pdf|max:20480']);
        if ($request->file()) {
            $module = Module::find($id);
            // print_r($module);
            // exit;
            $module->name = $request->module_name;
			 $module->description = $request->description;
            $module->month = $request->module_description;
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            // $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->file('file')->move(public_path('images'), $fileName);
            $module->file_name = time() . '_' . $request->file->getClientOriginalName();
            // $module->file_path = '/storage/' . $filePath;
            $module->file_path = $filePath;
            $module->save();
        }



        return back()->with('success', 'Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $module = Module::find($id);
        if (!is_null($module)) {
            foreach ($module->subjects as $subject) {
                $subject->delete();
            }
            $module->delete();
        }
        return back()->with('success', 'Data has been deleted.');
    }

    public function approve($id)
    {
        $data['approvallist'] = DB::table('module_wise_courses')
            ->select('module_wise_courses.module_id', 'module_wise_courses.subject_id', 'participants.name')
            ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
            ->where('module_wise_courses.module_id', '=', $id)
            ->get();



        //print_r($data['approvallist']);
        //exit;
        return view('pages.module.edit', $data);
    }

    public function report($id)
    {
        

       // $id=Crypt::decryptString($id);

         $data['module'] = DB::table('modules')
            ->select('modules.id', 'modules.name','modules.created_at as updated_at','modules.description','modules.month', 'modules.batch_id', 'batches.name as filename', 'participants.name as created_name', 'modules.file_name', 'modules.file_path', 'subjects.name as designame','modules.note_no','modules.subnote','modules.created_by','participants.signature_file_name','participants.signature_file_path')
            ->join('batches', 'modules.batch_id', '=', 'batches.id')
            ->join('participants', 'modules.created_by', '=', 'participants.id')
            ->join('subjects', 'participants.desig_id', '=', 'subjects.id')
            ->where('modules.id', '=', $id)
            ->orwhere('modules.moduleid', '=', $id)    
            ->get();
    //  print_r($data['module']);
    //  exit;

         

		   $data['querylist']= DB::table('queries')
              ->select('queries.query_question','queries.query_answer','queries.note_id','queries.send_from','queries.send_to','queries.query_status','participants.name as sending_person','users.name as sendto_person')
              ->join('participants', 'queries.send_from', '=', 'participants.id')
              ->join('users', 'queries.send_to', '=', 'users.id')
              ->join('modules', 'queries.note_id', '=', 'modules.id')
              //->where('modules.moduleid', '=', $id)
              ->where('queries.note_id', '=', $id)
              ->get();

              
 //print_r( $data['querylist'] );
 //exit;
              


          $data['remarklist'] = DB::table('module_wise_courses')
              ->select('modules.id', 'module_wise_courses.subject_id', 'participants.name', 'module_wise_courses.remarks', 'module_wise_courses.flag', 'module_wise_courses.updated_at', 'subjects.name as designame','intakes.name as deptname','module_wise_courses.file_name','module_wise_courses.file_path','participants.signature_file_name','participants.signature_file_path')
              ->join('modules', 'module_wise_courses.module_id', '=', 'modules.id')
              ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
              ->join('subjects', 'participants.desig_id', '=', 'subjects.id')
              ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
              ->where('modules.id', '=', $id)
              ->orwhere('modules.moduleid', '=', $id)
              ->where('module_wise_courses.flag', '!=', 0)
              ->get();


        $data['subnoteremarklist'] = DB::table('module_wise_courses')
              ->select('modules.id', 'module_wise_courses.subject_id', 'participants.name', 'module_wise_courses.remarks', 'module_wise_courses.flag', 'module_wise_courses.updated_at', 'subjects.name as designame','intakes.name as deptname')
              ->join('modules', 'module_wise_courses.module_id', '=', 'modules.id')
              ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
              ->join('subjects', 'participants.desig_id', '=', 'subjects.id')
              ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
              ->where('modules.moduleid', '=', $id)
              ->where('module_wise_courses.flag', '!=', 0)
              ->get();  


         



    // print_r( $data['remarklist'] );
   // exit; 
            
        $filename = $id;
//echo $filename;
//exit;
        
          $attachment='';
          foreach($data['module'] as $note_attach){
            if($note_attach->file_name!='')

            {$attachment= $note_attach->file_name;}
           
        }
           
        
     // echo $attachment;
      // exit;
       
      
         
          $path = public_path('pdf' . '/' . $filename . '.pdf');
          $pdf = PDF::loadView('pages.report.index', $data, [], [
              'mode'                  => 'utf-8',
              'default_font' => 'nikosh'
          ])->save('' . $path);
          $header = [
              'Content-Type' => 'application/pdf',
  
          ];


          if($attachment=='')
          {
            return response()->file($path, $header);
          }
         else
         {
        //echo $attachment;
       // exit;
            
            $filename = $filename. '.pdf';

            $firstFileNewPath = public_path('merged' . '/' . $filename);
            $firstFileOldPath = public_path('pdf' . '/' . $filename);
            $resultOne = shell_exec('"C:\Program Files\gs\gs9.56.1\bin\gswin64c" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dBATCH -sOutputFile="' . $firstFileNewPath . '" "' . $firstFileOldPath . '" 2>&1');
    
            $files = array();    
            array_push($files,$firstFileNewPath);
            $i=1;

      foreach ($data['module'] as $note_file) {
                //dd($data['module']);

                $fileName = $note_file->file_name;
                $subnote = $note_file->subnote;
                $noteNo = $note_file->note_no;

                $fpdi = new FPDI;
                $filePath =  $note_file->file_path;


            //    dd($files[$i]);

                $count = $fpdi->setSourceFile($filePath);

                // print_r($count);
                // exit;
                for ($t = 1; $t <= $count; $t++) {
                    

                    if ($subnote == '') {
                        $template = $fpdi->importPage($t);
                        $size = $fpdi->getTemplateSize($template);
                        $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
                        $fpdi->useTemplate($template);
                        $left = 10;
                        $top = 10;

                        $text = "(Note:" . $noteNo . " )";
                        $fpdi->SetFont("arial", "", 12);
                        $fpdi->SetTextColor(153, 0, 153);
                        $fpdi->Text($left, $top, $text);
                    } else {

                        $template = $fpdi->importPage($t);
                        $size = $fpdi->getTemplateSize($template);
                        $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
                        $fpdi->useTemplate($template);
                        $left = 10;
                        $top = 10;

                        $text = "(Note:" . $noteNo . " ) Subnote : " . $subnote;
                        $fpdi->SetFont("arial", "", 12);
                        $fpdi->SetTextColor(153, 0, 153);
                        $fpdi->Text($left, $top, $text);
                    }
                }

                $fpdi->Output(public_path('images_note' . '/' . $fileName), 'F');

                $files[$i] = public_path('images_note' . '/' . $fileName);
             

            //    print_r($i." ".$files[$i]);

            //    echo "<br/>-->".$i;
                $i++;
            }
            // $files = [$firstFilePath, $secondFileNewPath, $thirdFileNewPath];
            $fpdi = new FPDI;


            foreach ($files as $file) {
                $filename = $file;
                $count = $fpdi->setSourceFile($filename);
                for ($i = 1; $i <= $count; $i++) {
                    $template = $fpdi->importPage($i);
                    $size = $fpdi->getTemplateSize($template);
                    $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
                    $fpdi->useTemplate($template);
                }
            }
            $fpdi->Output(public_path('/mergednote-pdf.pdf'), 'F');
            return response()->file(public_path('/mergednote-pdf.pdf'), $header);
        }
    }

    public function close()
    {
        return Redirect()->route('module.index');
    }

    public function createflow()
    {
        return view('pages.module.flow');
    }
    public function viewreport()
    {
        $batches = Batch::get();
        return view('pages.report.viewreport', compact('batches'));
    }

    public function search(Request $request){


        if(auth()->user()->role=='3'|| auth()->user()->role=='4')
        {

            if($request->ajax()) {
          
                $data = Batch::where('year', 'LIKE','%'. $request->country.'%')
                    ->get();
    
               
                $output = '';
               
                if (count($data)>0) {
                  
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                  
                    foreach ($data as $row){
                       
                        $output .= '<li class="list-group-item">'.$row->year.'</li>';
                    }
                  
                    $output .= '</ul>';
                }
                else {
                 
                    $output .= '<li class="list-group-item">'.'No results'.'</li>';
                }
               
                return $output;
            }
        }
            else
            {
                if($request->ajax()) {
          
                    $data =DB::table('batches')
                    ->join('participants', 'batches.intake_id', '=', 'participants.intake_id')
                    ->where('year', 'LIKE','%'. $request->country.'%')
                    ->where('participants.id','=', auth()->user()->id)
                    
                    ->get();
        
                   
                    $output = '';
                   
                    if (count($data)>0) {
                      
                        $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                      
                        foreach ($data as $row){
                           
                            $output .= '<li class="list-group-item">'.$row->year.'</li>';
                        }
                      
                        $output .= '</ul>';
                    }
                    else {
                     
                        $output .= '<li class="list-group-item">'.'No results'.'</li>';
                    }
                   
                    return $output;
            }
          
        }
       
      
    }
	
	 public function searchfile(Request $request){


        if(auth()->user()->role=='3'|| auth()->user()->role=='4')
        {

            if($request->ajax()) {
          
                $data = Batch::where('name', 'LIKE','%'. $request->filename.'%')
                ->get();
    
               
                $output = '';
               
                if (count($data)>0) {
                  
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                  
                    foreach ($data as $row){
                       
                        $output .= '<li class="list-group-item">'.$row->name.'</li>';
                    }
                  
                    $output .= '</ul>';
                }
                else {
                 
                    $output .= '<li class="list-group-item">'.'No results'.'</li>';
                }
               
                return $output;
            }
        }
            else
            {
                if($request->ajax()) {
          
                    $data = Batch::where('name', 'LIKE','%'. $request->filename.'%')
                    ->where ('intake_id','=',auth()->user()->intake_id)
                    ->get();
        
                   
                    $output = '';
                   
                    if (count($data)>0) {
                      
                        $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                      
                        foreach ($data as $row){
                           
                            $output .= '<li class="list-group-item">'.$row->name.'</li>';
                        }
                      
                        $output .= '</ul>';
                    }
                    else {
                     
                        $output .= '<li class="list-group-item">'.'No results'.'</li>';
                    }
                   
                    return $output;
            }
          
        }
    }


    public function reportview(Request $request)
    {
        $file_no = $request->country;
		$filename = $request->filename;

        
       
        $data['file'] = DB::table('batches')
              ->select('batches.id', 'batches.name as file_name', 'batches.year as file_no')
              ->where('batches.year', '=',$file_no)
			  ->orwhere('batches.name', '=',$filename)
              ->first();
           
             
          $data['notes'] = DB::table('modules')
              ->select('modules.id', 'modules.name','modules.created_at  as updated_at','modules.description', 
			  'modules.month', 'modules.batch_id', 'batches.name as filename', 'participants.name as created_name', 
			  'modules.name as note_name','modules.file_name', 'modules.file_path', 'subjects.name as designame',
			  'modules.note_no','modules.created_by')
              ->join('batches', 'modules.batch_id', '=', 'batches.id')
              ->join('participants', 'modules.created_by', '=', 'participants.id')
              ->join('subjects', 'participants.desig_id', '=', 'subjects.id')
              ->where('modules.batch_id', '=', $data['file']->id)
              ->wherenull('modules.subnote')
              ->get();

        $data['subnotes'] = DB::table('modules')
              ->select('modules.id', 'modules.name','modules.created_at  as updated_at','modules.description', 
			  'modules.month', 'modules.batch_id', 'batches.name as filename', 'participants.name as created_name',
			  'modules.name as note_name','modules.file_name', 'modules.file_path', 'subjects.name as designame',
			  'modules.note_no','modules.subnote')
              ->join('batches', 'modules.batch_id', '=', 'batches.id')
              ->join('participants', 'modules.created_by', '=', 'participants.id')
              ->join('subjects', 'participants.desig_id', '=', 'subjects.id')
              ->where('modules.batch_id', '=', $data['file']->id)
              //->where('modules.note_no', '=', $data['file']->note_no)
              ->wherenotnull('modules.subnote')
              ->get();

        //    print_r( $data['subnotes'] );
        //     exit;   

		   $data['querylist']= DB::table('queries')
              ->select('queries.query_question','queries.query_answer','queries.note_id','queries.send_from','queries.send_to','queries.query_status','participants.name as sending_person','users.name as sendto_person')
              ->join('participants', 'queries.send_from', '=', 'participants.id')
              ->join('users', 'queries.send_to', '=', 'users.id')
              ->join('modules', 'queries.note_id', '=', 'modules.id')
              ->where('modules.batch_id', '=', $data['file']->id)
              ->get();
              
          $data['remarklist'] = DB::table('module_wise_courses')
              ->select('modules.id', 'module_wise_courses.subject_id', 'participants.name', 
			  'module_wise_courses.remarks', 'module_wise_courses.flag', 'module_wise_courses.updated_at', 
			  'subjects.name as designame','module_wise_courses.file_name','module_wise_courses.file_path')
              ->join('modules', 'module_wise_courses.module_id', '=', 'modules.id')
              ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
              ->join('subjects', 'participants.desig_id', '=', 'subjects.id')
              ->where('modules.batch_id', '=', $data['file']->id)
              ->where('module_wise_courses.flag', '!=', 0)
              ->get();
			  
			  
			  
        $data['allnotes'] = DB::table('modules')
            ->select('modules.id', 'modules.batch_id as fileid', 'modules.name as note_name', 'modules.file_name', 
			'modules.file_path', 'modules.note_no', 'modules.subnote')
            ->join('batches', 'modules.batch_id', '=', 'batches.id')
            ->where('modules.batch_id', '=', $data['file']->id)
            ->get();
            
          $filename = $data['file']->id; 
          
          $attachment='';
          foreach($data['notes'] as $note_attach){
            $attachment= $note_attach->file_name;
        }
       
       
      
         
          $path = public_path('pdf' . '/' . $filename . '.pdf');
          $pdf = PDF::loadView('pages.report.loadreport', $data, [], [
              'mode'                  => 'utf-8',
              'default_font' => 'nikosh'
          ])->save('' . $path);
          $header = [
              'Content-Type' => 'application/pdf',
  
          ];


          if($attachment=='')
          {
            return response()->file($path, $header);
          }
         else
         {
        //  echo $attachment;
        //  exit;
            
            $filename = $filename. '.pdf';

            $firstFileNewPath = public_path('merged' . '/' . $filename);
            $firstFileOldPath = public_path('pdf' . '/' . $filename);
            $resultOne = shell_exec('"C:\Program Files\gs\gs9.56.1\bin\gswin64c" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dBATCH -sOutputFile="' . $firstFileNewPath . '" "' . $firstFileOldPath . '" 2>&1');
    
            $files = array();    
            array_push($files,$firstFileNewPath);
            $i=1;
			
                foreach ($data['allnotes'] as $note_file) {
                //  dd($data['allnotes']);

                $fileName = $note_file->file_name;
                $subnote = $note_file->subnote;
                $noteNo = $note_file->note_no;

                $fpdi = new FPDI;
                $filePath =  $note_file->file_path;


            //    dd($files[$i]);

                $count = $fpdi->setSourceFile($filePath);

                // print_r($count);
                // exit;
                for ($t = 1; $t <= $count; $t++) {
                    

                    if ($subnote == '') {
                        $template = $fpdi->importPage($t);
                        $size = $fpdi->getTemplateSize($template);
                        $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
                        $fpdi->useTemplate($template);
                        $left = 10;
                        $top = 10;

                        $text = "(Note:" . $noteNo . " )";
                        $fpdi->SetFont("arial", "", 12);
                        $fpdi->SetTextColor(153, 0, 153);
                        $fpdi->Text($left, $top, $text);
                    } else {

                        $template = $fpdi->importPage($t);
                        $size = $fpdi->getTemplateSize($template);
                        $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
                        $fpdi->useTemplate($template);
                        $left = 10;
                        $top = 10;

                        $text = "(Note:" . $noteNo . " ) Subnote : " . $subnote;
                        $fpdi->SetFont("arial", "", 12);
                        $fpdi->SetTextColor(153, 0, 153);
                        $fpdi->Text($left, $top, $text);
                    }
                }

                $fpdi->Output(public_path('images_report' . '/' . $fileName), 'F');

                $files[$i] = public_path('images_report' . '/' . $fileName);
             

            //    print_r($i." ".$files[$i]);

            //    echo "<br/>-->".$i;
                $i++;
            }
// dd($files);
            // $files = [$firstFilePath, $secondFileNewPath, $thirdFileNewPath];
            $fpdi = new FPDI;

           
            foreach ($files as $file) {
               // dd($files);
                $filename = $file;

                $count = $fpdi->setSourceFile($filename);

                for ($i = 1; $i <= $count; $i++) {
                    $template = $fpdi->importPage($i);
                    $size = $fpdi->getTemplateSize($template);
                    $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
                    $fpdi->useTemplate($template);
                }
            }
            $fpdi->Output(public_path('/merged-pdf.pdf'), 'F');
            return response()->file(public_path('/merged-pdf.pdf'), $header);
        }
     }
 public function notelist()
    {
       
     
        if(auth()->user()->role=='2' && auth()->user()->replace_flow !='1')
       {  $data['notelistall'] = DB::table('modules')
        ->select('batches.name as filename', 'modules.name', 'modules.id','modules.note_no', 'modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status','modules.subnote'
        ,'modules.created_at','modules.updated_at','participants.name as created_by')
        ->join('batches', 'batches.id', '=', 'modules.batch_id')
        ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
        ->join('participants', 'modules.created_by', '=', 'participants.id')
        ->where('intakes.id','=', auth()->user()->intake_id)
        ->paginate(15);
   
}


        if(auth()->user()->role=='2' && auth()->user()->replace_flow =='1')
        {
            $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->whereNull('modules.status')
                ->paginate(15);
                
            }

        if(auth()->user()->replace_flow =='1')
        {
            $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->whereNull('modules.status')
                ->paginate(15);
                
        }
       if(auth()->user()->role!='2'&& auth()->user()->replace_flow !='1'){   
        $data['notelistall'] = DB::table('modules')
        ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
        ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
        ->join('batches', 'batches.id', '=', 'modules.batch_id')
        ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
        ->join('participants', 'modules.created_by', '=', 'participants.id')
        ->paginate(15);

       
        }
     
        $intakes = Intake::get();
        return view('pages.module.notelist',compact('intakes'),$data);
    }

    public function filtering(Request $request)
    {
       $deptid=$request->intake_id;
        $data['FilterType']=$request->input('action');

        if(auth()->user()->role=='2')

        {
            if($data['FilterType']=='Approve')

            {
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id','modules.note_no', 'modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.status','=', 'Approved')
                ->whereNull('modules.paid')
                ->where('intakes.id','=', auth()->user()->intake_id)
                //->where('intakes.id','=', $deptid)
                ->get();          

            }
            if($data['FilterType']=='Reject')
    
            {
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.status','=', 'Rejected')
                ->where('intakes.id','=', auth()->user()->intake_id)
                //->where('intakes.id','=', $deptid)
                ->get(); 
                // print_r($data['notelistall'] );
                // exit;  
            }

            if($data['FilterType']=='Board')
    
            {   
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')             
                ->where('modules.status','=', 'Board')
                ->where('intakes.id','=', auth()->user()->intake_id)
                ->where('intakes.id','=', $deptid)
                ->get();
    
    
            }
            if($data['FilterType']=='paid')

            {
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id','modules.note_no', 'modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.status','=', 'Approved')
                ->where('modules.paid','=', 'Y')
                ->where('intakes.id','=', auth()->user()->intake_id)
               // ->where('intakes.id','=', $deptid)
                ->get();

            }

            if($data['FilterType']=='Pending')
            {
                if(auth()->user()->replace_flow =='1')
                {
                    $data['notelistall'] = DB::table('modules')
                    ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                    ,'modules.created_at','modules.updated_at','participants.name as created_by','users.name as pending_name','modules.subnote')
                    ->join('batches', 'batches.id', '=', 'modules.batch_id')
                    ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                    ->join('participants', 'modules.created_by', '=', 'participants.id')
                    ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
                    ->join('users', 'module_wise_courses.subject_id', '=', 'users.id')
                    ->where('module_wise_courses.flag','=',0)
                    ->whereNull('modules.status')
                   // ->where('intakes.id','=', $deptid)
                    ->get();
                }
               else
               {
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','users.name as pending_name','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
                ->join('users', 'module_wise_courses.subject_id', '=', 'users.id')
                ->where('module_wise_courses.flag','=',0)
                ->whereNull('modules.status')
                ->where('intakes.id','=', auth()->user()->intake_id)
               // ->where('intakes.id','=', $deptid)        
                ->get();


               }

            }
			
			
			 if($data['FilterType']=='searchnote')
            {
                
                $note_subject = $request->notesubject;
                  if(empty($note_subject)) {
                    dd('Please enter note subject.');
                }
                
              
                $data['singlenote'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.name','=', $note_subject)
                ->first();
                if($data['singlenote']->status=='')
                {
                                $data['notelistall'] = DB::table('modules')
                                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                                ,'modules.created_at','modules.updated_at','participants.name as created_by','users.name as pending_name','modules.subnote')
                                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                                ->join('participants', 'modules.created_by', '=', 'participants.id')
                                ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
                                ->join('users', 'module_wise_courses.subject_id', '=', 'users.id')
                                ->where('module_wise_courses.flag','=',0)
                                ->where('modules.id','=', $data['singlenote']->id)
                                ->get();

                                // print_r( $data['notelistall']);
                                // exit;


                }

                else
                {
                    $data['notelistall'] = DB::table('modules')
                    ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                    ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                    ->join('batches', 'batches.id', '=', 'modules.batch_id')
                    ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                    ->join('participants', 'modules.created_by', '=', 'participants.id')
                    ->where('modules.id','=', $data['singlenote']->id)
                    ->get();
// print_r( $data['notelistall']);
// exit;

                }
            }

            if($data['FilterType']=='fileandnote')
            {
                $note_no = $request->noteno;
                $filename = $request->filename;
                  if(empty($note_no)&& empty($filename)) {
                    dd('Please enter filename and  noteno.');
                }
                
              
                $data['notelistall'] = DB::table('modules')
                    ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                    ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote','modules.moduleid')
                    ->join('batches', 'batches.id', '=', 'modules.batch_id')
                    ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                    ->join('participants', 'modules.created_by', '=', 'participants.id')
                    ->where('batches.name','=', $filename)
                    ->where('modules.note_no','=', $note_no)
                    ->get();
            }


        }
        if( auth()->user()->replace_flow =='1')
        {
            if($data['FilterType']=='Pending')

            {
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','users.name as pending_name','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
                ->join('users', 'module_wise_courses.subject_id', '=', 'users.id')
                ->where('module_wise_courses.flag','=',0)
                ->whereNull('modules.status')
                ->where('intakes.id','=', $deptid)
                ->get();
                
            }
        }

        if(auth()->user()->role!='2' && auth()->user()->replace_flow !='1')
        {

            if($data['FilterType']=='Approve')
            {
				 if(empty($deptid)) {
                    dd('Please select department.');
                }

                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.status','=', 'Approved')
                ->whereNull('modules.paid')
                ->where('intakes.id','=', $deptid)
                ->get();
    
            }
            if($data['FilterType']=='Reject')
            {
				 if(empty($deptid)) {
                    dd('Please select department.');
                }
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.status','=', 'Rejected')
                ->where('intakes.id','=', $deptid)
                ->get();

            }
            if($data['FilterType']=='Board')
            { if(empty($deptid)) {
                    dd('Please select department.');
                }
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.status','=', 'Board')
                ->where('intakes.id','=', $deptid)
                ->paginate(15);
            }

            if($data['FilterType']=='paid')
            { if(empty($deptid)) {
                    dd('Please select department.');
                }

                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.status','=', 'Approved')
                ->where('modules.paid','=', 'Y')
                ->where('intakes.id','=', $deptid)
                ->get();
            }

            if($data['FilterType']=='Pending')

            { if(empty($deptid)) {
                    dd('Please select department.');
                }
                $data['notelistall'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','users.name as pending_name','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
                ->join('users', 'module_wise_courses.subject_id', '=', 'users.id')
                ->where('module_wise_courses.flag','=',0)
                ->whereNull('modules.status')
                ->where('intakes.id','=', $deptid)
                ->get();

            }
			
			if($data['FilterType']=='searchnote')
            {
                
                $note_subject = $request->notesubject;
                
               if(empty($note_subject)) {
                    dd('Please enter note subject.');
                }
                $data['singlenote'] = DB::table('modules')
                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                ->join('participants', 'modules.created_by', '=', 'participants.id')
                ->where('modules.name','=', $note_subject)
                ->first();
                if($data['singlenote']->status=='')
                {
                                $data['notelistall'] = DB::table('modules')
                                ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                                ,'modules.created_at','modules.updated_at','participants.name as created_by','users.name as pending_name','modules.subnote')
                                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                                ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                                ->join('participants', 'modules.created_by', '=', 'participants.id')
                                ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
                                ->join('users', 'module_wise_courses.subject_id', '=', 'users.id')
                                ->where('module_wise_courses.flag','=',0)
                                ->where('modules.id','=', $data['singlenote']->id)
                                ->get();

                                // print_r( $data['notelistall']);
                                // exit;


                }

                else
                {
                    $data['notelistall'] = DB::table('modules')
                    ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                    ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote')
                    ->join('batches', 'batches.id', '=', 'modules.batch_id')
                    ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                    ->join('participants', 'modules.created_by', '=', 'participants.id')
                    ->where('modules.id','=', $data['singlenote']->id)
                    ->get();
// print_r( $data['notelistall']);
// exit;

                }
            }

            if($data['FilterType']=='fileandnote')
            {
                $note_no = $request->noteno;
                $filename = $request->filename;
                  if(empty($note_no)&& empty($filename)) {
                    dd('Please enter filename and  noteno.');
                }
                
              
                $data['notelistall'] = DB::table('modules')
                    ->select('batches.name as filename', 'modules.name', 'modules.id', 'modules.note_no','modules.file_name', 'modules.forwarded', 'modules.status', 'modules.month', 'modules.tranche', 'intakes.name as department', 'batches.year', 'modules.note_status'
                    ,'modules.created_at','modules.updated_at','participants.name as created_by','modules.subnote','modules.moduleid')
                    ->join('batches', 'batches.id', '=', 'modules.batch_id')
                    ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
                    ->join('participants', 'modules.created_by', '=', 'participants.id')
                    ->where('batches.name','=', $filename)
                    ->where('modules.note_no','=', $note_no)
                    ->get();
            }

        }

        $intakes = Intake::get();
        return view('pages.module.notelistfilter',compact('intakes'),$data);

    }
     
	 public function searchnote(Request $request)

{


    if(auth()->user()->role=='3'|| auth()->user()->role=='4')
    {

        if($request->ajax()) {
      
            $data = Module::where('name', 'LIKE','%'. $request->notesubject.'%')
                ->get();

           
            $output = '';
           
            if (count($data)>0) {
              
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
              
                foreach ($data as $row){
                   
                    $output .= '<li class="list-group-item">'.$row->name.'</li>';
                }
              
                $output .= '</ul>';
            }
            else {
             
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
           
            return $output;
        }
    }
        else
        {
            if($request->ajax()) {
      
                $data =DB::table('modules')
                ->select('modules.name')
                ->join('batches', 'batches.id', '=', 'modules.batch_id')
                ->join('participants', 'batches.intake_id', '=', 'participants.intake_id')
                ->where('participants.id','=', auth()->user()->id)
                ->where('modules.name', 'LIKE','%'. $request->notesubject.'%')                   
                ->get();
    
               
                $output = '';
               
                if (count($data)>0) {
                  
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                  
                    foreach ($data as $row){
                       
                        $output .= '<li class="list-group-item">'.$row->name.'</li>';
                    }
                  
                    $output .= '</ul>';
                }
                else {
                 
                    $output .= '<li class="list-group-item">'.'No results'.'</li>';
                }
               
                return $output;
        }
      
    }
   
  
}
	 
    public function filter($id)
    {


        // $input = $request->input('action');


    }


    public function ViewNote($id)
    {   
        $data['module']=DB::table('modules')
        ->select('modules.id','modules.name','modules.month','modules.batch_id','batches.name as filename','modules.file_name')
        ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
        ->join('batches', 'modules.batch_id', '=', 'batches.id')
        //->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
        ->where('modules.id','=', $id)
        ->first();
      // print_r($data['module']);
      // exit;

      $data['remarklsit']=DB::table('module_wise_courses')
        ->select('module_wise_courses.id','module_wise_courses.subject_id','participants.name','module_wise_courses.remarks','module_wise_courses.flag')
        ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
        ->where('module_wise_courses.module_id','=', $id)
        ->get();

    $data['subjectList']=DB::table('participants')
        ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
        ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
        ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
        ->where('participants.is_flow','=', 1)
        ->get();
        // print_r($data1['remarklsit']);
        // exit;

     
        return view('pages.module.approvaledit', $data);



    }


 }
 

    

    

