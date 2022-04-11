<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Validator;

class PostController extends Controller
{
    use ApiResponseTrait;

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required' ,
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:png,jpg,gif,jpeg',
        ]);
        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }

        $post = new Post();

        if ($request->hasFile('image')) {
            $file_name = $request->image->getClientOriginalName();
            $name = time().$file_name;
            $file = $request->image->store('public/posts');
            $request->image ->move('posts',$name);
            $post -> image = 'posts/'.$name ;
        }
        $post ->title = $request->title;
        $post ->content = $request->content;
        $post ->category_id = $request->category_id;
        $post ->save();

        if($post){

            return $this->apiResponse($post ,'Post added successfully', 200);
        }
        return $this->apiResponse(null ,'Something error', 400);

    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required | numeric',
            'title' => 'required' ,
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:png,jpg,gif,jpeg',
        ]);
        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }
        $post = Post::find($request->id);
        if(!$post){
            return $this->apiResponse(null ,'post Not Found',400);

        }
        if($request->hasFile('image')) {
            
            $file_path = $post->image;
            if(\File::exists(public_path($file_path))){
                \File::delete(public_path($file_path));
            }
            $file_name = $request->image->getClientOriginalName();
            $name = time().$file_name;
            $file = $request->image->store('public/posts');
            $request->image ->move('posts',$name);
            $post -> image = 'posts/'.$name ;
        }

        $post ->title = $request->title;
        $post ->content = $request->content;
        $post ->category_id = $request->category_id;
        $post->save();
        
        return $this->apiResponse($post ,'post updated successfuly',200);
        
    }

    public function destroy(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required | numeric',
        ]);
        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }
        $post = Post::find($request->id);
        if($post){
            $post->delete();
            return $this->apiResponse(null ,'post deleted successfuly',200);
        }

        return $this->apiResponse(null ,'something error',400);
        

    }  

    public function postsList(){
        $posts = Post::all();
        return $this->apiResponse($posts ,'All posts',200);

    }

    public function showPost(Request $request){
        
        $validator = Validator::make($request->all(), [
            'id' => 'required | numeric',
        ]);
        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }
        $post = Post::find($request->id);
        if($post){
        return $this->apiResponse($post ,'ok',200);

        }
        return $this->apiResponse(null ,'something wrong',400);

    }

    public function categoryPosts(Request $request){
        
        $validator = Validator::make($request->all(), [
            'category_id' => 'required | numeric',
        ]);
        if ($validator->fails()){

            return $this->apiResponse(null ,$validator->errors(),400);

        }
        $posts = Post::where('category_id' , $request->category_id)->get();
        if($posts){
        return $this->apiResponse($posts ,'ok',200);

        }
        return $this->apiResponse(null ,'something wrong',400);

    }

    

}
