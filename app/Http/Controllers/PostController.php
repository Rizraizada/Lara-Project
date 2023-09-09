<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response ;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    public function showallposts()

    {


        $response=Http::get('https://jsonplaceholder.typicode.com/users');
      
        //return json_decode($response);
        return view ("posts",["posts"=>json_decode($response)]);

      
    }
    
    public function singlepost($id)

    {

        $response =  Http::get('https://jsonplaceholder.typicode.com/users',['id' => $id ]);

        return view ("posts",["posts"=>json_decode($response)]);
    


    }

    //
}
