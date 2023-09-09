<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\Intake;
use App\Models\User;
use App\Models\userrole;
use App\Models\RolewisePermission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Crypt;


use Illuminate\Support\Facades\Hash;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
       
        $intakes = Intake::get();
        $designations = Subject::get();
        $roles = userrole::get();

        $data['userlist']=DB::table('participants')
        ->select('participants.id','participants.name','participants.email','participants.phone_no','participants.desig_id','participants.intake_id','intakes.name as department','subjects.name as designation','participants.signature_file_name','participants.role','participants.is_flow'
        ,'participants.is_mdlist','participants.role','participants.replace_flow')
        ->join('users', 'users.id', '=', 'participants.id')
        ->join('intakes', 'intakes.id', '=', 'participants.intake_id')
        ->join('subjects', 'subjects.id', '=', 'participants.desig_id')
       // ->where('participants.role','!=', '3')
        ->paginate(10);

       // print_r($data['userlist']);
       // exit;
        return view('pages.participant.index', compact('designations','intakes','roles'),$data);
    
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

        $validator = $request->validate([
        'email'=>'required|unique:users',
        'name'=>'required|max:20',
        'password'=>'required|min:8|max:12|string',
            ]);
      
    //dd($request->all());
       
        
        $participant = new Participant();
        $participant->name = $request->name;
        $participant->email = $request->email;
        $participant->phone_no = $request->phone_no;
        $participant->intake_id = $request->intake_id;
        $participant->desig_id = $request->desig_id;
        $participant->password=Hash::make($request->password);
        $participant->role = $request->type_id;
        $participant->is_flow = $request->status;
        $participant->is_mdlist = $request->forward;
        $participant->save();

       

        // $count = Participant::where('email', '=', $request->email)->count();
        // if($count>0)
        //  {   return back()->with('error','This email already exists.');

        //  }

     

        $data=new user();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->role=$request->type_id;
        $data->desig_id = $request->desig_id;
        $data->intake_id = $request->intake_id;
        $data->save();

        $request->validate(['file' => 'required|mimes:jpg,png|max:1024' ]);
        if($request->file()) {
       
          
            $fileName = time().'_'.$request->file->getClientOriginalName();
            // $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->file('file')->move(public_path('images'), $fileName);
            $participant->signature_file_name = time().'_'.$request->file->getClientOriginalName();
            // $module->file_path = '/storage/' . $filePath;
            $participant->signature_file_path = $filePath;
                  
        }
       
        $participant->save();
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
        $user = Participant::find($id);
        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->intake_id = $request->intake_id;
        $user->desig_id = $request->desig_id;
        $user->is_flow = $request->status;
        $user->is_mdlist = $request->forward;
        $user->replace_flow = $request->replaceflow;
        $user->role = $request->type_id;
      
      


      if($request->file('file')!='')

        {

        $request->validate(['file' => 'required|mimes:jpg,png|max:1024' ]);
        if($request->file()) {
       
          
            $fileName = time().'_'.$request->file->getClientOriginalName();
            // $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->file('file')->move(public_path('images'), $fileName);
            $user->signature_file_name = time().'_'.$request->file->getClientOriginalName();
            // $module->file_path = '/storage/' . $filePath;
            $user->signature_file_path = $filePath;
            $user->save();      
        }
    }
    else
    {  $user->save();}

        $user_data = User::find($id);
        $user_data->name = $request->user_name;
        $user_data->email = $request->email;
        $user_data->desig_id = $request->desig_id;
        $user_data->intake_id = $request->intake_id;
        $user_data->role = $request->type_id;
        $user_data->replace_flow = $request->replaceflow;
        $user_data->save();
       

        return back()->with('success','Data has been updated.');
       
        //
    }


    public function pass_update(Request $request, $id)
    {
        $user_data = User::find($id);
        $user_data->password =bcrypt($request->user_pass);
        $user_data->save();


     return back()->with('success',' your password has been changed.');

    }

    public function password_update(Request $request)
    {
        
        $request->validate([
            'current_password'=>'required',
            'password'=>'required|min:8|max:12|string|confirmed',
            'password_confirmation'=>'required',
                ]);
        
        $user=Auth::user();
        if(Hash::check($request->current_password,Auth::user()->password))

        {

            $user->password=Hash::make($request->password);
            $user_data = User::find(Auth::user()->id);
            $user_data->password=Hash::make($request->password);
            $user_data->save();
            return back()->with('success','  password has been changed .');
            //Auth::logout();
            //return redirect()->route('login');
            
        }
        else
        {
            return back()->with('error',' current password does not match.');

        }


    }


    public function passchange()
    {

     return view('pages.participant.changepassword');

    }

    public function setpermission($id)
    {

        $data['permissions']=DB::table('rolewise_permission')
        ->select('rolewise_permission.role_id','rolewise_permission.permission_id','permissionname.permission_name')
        ->join('permissionname', 'rolewise_permission.permission_id', '=', 'permissionname.id')
        ->where('rolewise_permission.role_id','=', $id)
        ->distinct()
        ->get();

        $data['role_id']=$id;

      

        $data['allpermissions']=DB::table('permissionname')
        ->select('id','permission_name')
        ->get();

        return view('pages.participant.setpermission', $data);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       
        $user = Participant::find($id);
        $user1=User::find($id);
      
            $user->delete();
            $user1->delete();
        
        return back()->with('success','Data has been deleted.');
        //
    }

    public function deletepermission(Request $request,$id)
    {
       $role_id=$request->roleid;
    
        $permission = RolewisePermission::where('permission_id', '=', $id)
        ->where('role_id', '=',  $role_id)
        ->first();
      
        //  print_r($permission);
        //  exit;
         $permission->delete();
        return back()->with('success','permission has been deleted.');
        //
    }

    public function setrole(Request $request, $id)

    {
    
        for ($i = 0; $i < sizeof($request->permissions); $i++) {
            $role = new RolewisePermission();
            $role->role_id = $id;
            $role->permission_id = $request->permissions[$i];
            $role->save();
            return back()->with('success','permission has been added.');
        }

    }

    public function rolelist()
    {
        $rolelist = userrole::get();
        return view('pages.participant.rolelist', compact('rolelist'));
    }

    
}
