<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
// use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // public  $query;
    
    public function getAllPosts()  {
        return Post::all();

        // $query = DB::table('posts')
        // ->select('SELECT * FROM posts');
        // return $query;
    }
       
    public function addPost(Request $req)  {
        try{

            $post=new Post();
            $post->title=$req->title;
            $post->body=$req->body;

            if($post->save()){
                return response()->json(['status'=>'Successfull']);
            }
        }
        catch(\Exception $e){
            return response()->json(['status'=>'Mission Failed','message'=>$e ]);
        }

        

    }
}
