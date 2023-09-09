<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Archive;
use Illuminate\Support\Facades\DB;
use Auth;

class ArchiveController extends Controller
{

    public function index()
    {
       
        $data['archivelist']=DB::table('archive')
        ->select('archive.id','archive.file_heading','archive.file_name','archive.arcivetype','archive.file_path','users.name')
        ->join('users', 'archive.createdby', '=', 'users.id')
        ->where('archive.createdby','=', auth()->user()->id)
        ->where('archive.arcivetype','=', 0)
        ->orwhere('archive.arcivetype','=', 1)
        ->paginate(20);


    //    dd($data['archivelist']);
    //    exit; 
        return view('pages.archive.index',$data);
    }


    public function store(Request $request)
    {
        // dd($request);
       
        $archive = new Archive();

        $request->validate(['file' => 'required|mimes:jpg,png,pdf|max:20480']);
        if($request->file()) {
            
            $archive->file_heading = $request->title;
            $archive->arcivetype = $request->status;
            $archive->createdby=auth()->user()->id;
            $archive->dept_id=auth()->user()->intake_id;
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->move(public_path('archives'), $fileName);
            $archive->file_name = time().'_'.$request->file->getClientOriginalName();    
            $archive->file_path = $filePath;
            $archive->save(); 
                   

         }
         return back()->with('success','file has been saved.'); 
       
    }

    public function filter( Request $request)
    {
        $archivename = $request->notesubject;
        $data['FilterType']=$request->input('action');

        if($data['FilterType']=='personal')

        {
            $data['archivelist']=DB::table('archive')
            ->select('archive.id','archive.file_heading','archive.file_name','archive.arcivetype','archive.file_path','users.name')
            ->join('users', 'archive.createdby', '=', 'users.id')
            ->where('archive.createdby','=', auth()->user()->id)
            ->where('archive.arcivetype','=', 0)
            ->paginate(20);


        }

       
        if($data['FilterType']=='public')

        {
            $data['archivelist']=DB::table('archive')
            ->select('archive.id','archive.file_heading','archive.file_name','archive.arcivetype','archive.file_path','users.name')
            ->join('users', 'archive.createdby', '=', 'users.id')
            ->where('archive.arcivetype','=', 1)
            ->paginate(20);


        }
        

        if($data['FilterType']=='departemntal')

        {
            $data['archivelist']=DB::table('archive')
            ->select('archive.id','archive.file_heading','archive.file_name','archive.arcivetype','archive.file_path','users.name')
            ->join('users', 'archive.createdby', '=', 'users.id')
            ->join('intakes', 'users.intake_id', '=', 'intakes.id')
            ->where('intakes.id','=',auth()->user()->intake_id)
            ->where('archive.arcivetype','=', 2)
            ->paginate(20);


        }
       

        if($data['FilterType']=='find')

        {
            $data['archivelist']=DB::table('archive')
            ->select('archive.id','archive.file_heading','archive.file_name','archive.arcivetype','archive.file_path','users.name')
            ->join('users', 'archive.createdby', '=', 'users.id')
            ->where('archive.file_heading','=', $archivename)
            ->paginate(20);

         

        }


      

        return view('pages.archive.index',$data);
    }



    public function search(Request $request)

    {

    
            if($request->ajax()) {


                $data = Archive::where('archive.arcivetype','=', 1)
                    ->orwhere('archive.arcivetype','=', 0 )
                    ->where('archive.createdby','=', auth()->user()->id)
                    ->orwhere('archive.arcivetype','=', 2 )
                    ->where('archive.dept_id','=', auth()->user()->intake_id)
                     ->where('file_heading', 'LIKE','%'. $request->notesubject.'%')
                    ->get();

                $output = '';
               
                if (count($data)>0) {
                  
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                  
                    foreach ($data as $row){
                       
                        $output .= '<li class="list-group-item">'.$row->file_heading.'</li>';
                    }
                  
                    $output .= '</ul>';
                }
                else {
                 
                    $output .= '<li class="list-group-item">'.'No results'.'</li>';
                }
               
                return $output;
            }
        
        }
    //
}
