<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Models\Batch;
use App\Models\Template;
use App\Models\Module;
use App\Models\ModuleWiseCourse;
use App\Models\Subject;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
// use \PDF;
use PDF;
use Mail;

//use Illuminate\Http\Request;

class TemplateController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       if(auth()->user()->role!='3')
       {
        $data['templateslist']=DB::table('templates')
        ->select('templates.id','templates.template_name','templates.template_details','templates.created_by','participants.name')
        ->join('participants', 'templates.created_by', '=', 'participants.id')
        ->where('participants.intake_id','=', auth()->user()->intake_id)
        ->distinct()
        ->paginate(15);}
        if(auth()->user()->role=='3')
        {
        $data['templateslist']=DB::table('templates')
        ->select('templates.id','templates.template_name','templates.template_details','templates.created_by','participants.name')
        ->join('participants', 'templates.created_by', '=', 'participants.id')
        ->distinct()
        ->paginate(20);}

        return view('pages.template.index', $data);
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
        // dd($request);

        $template = new Template();
        $template->template_name = $request->module_name;
       
        $template->template_details = $request->month;
        $template->created_by=auth()->user()->id;
        $template->save();
        
           
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
        //
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
        $template = Template::find($id);
        $template->template_name = $request->module_name;
        $template->template_details = $request->module_description;
        $template->save();

        return back()->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $template = Template::find($id);
      
        $template->delete();
        return back()->with('success','Data has been deleted.');
    }



    public function report($id)
    {   
        $data['template']=DB::table('templates')
        ->select('templates.id','templates.template_name','templates.template_details')     
        ->where('templates.id','=', $id)
        ->first();


        $pdf = PDF::loadView('pages.report.template', $data, [],[
            'mode'                  => 'utf-8',
            'default_font' => 'nikosh'
        ]);
        $pdf->autoScriptToLang = true;
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('template.pdf');



    }

    public function close()
    {   
        return Redirect()->route('module.index');

    }

    public function sendmail()
    {   
        $data["email"] = "de.nayeem@gmail.com";
        $data["title"] = "From cityinsurance.com";
        $data["body"] = "This is Demo";
  
        $pdf = PDF::loadView('pages.emails.testmail', $data);
  
        Mail::send('pages.emails.testmail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
  
        dd('Mail sent successfully');

    }
}
