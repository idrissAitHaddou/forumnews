<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use Carbon\Carbon;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setlocale('fr');
        $posts = Post::orderBy("id", "desc")->with('user')->with('comments')->with('likes')->get();

        foreach($posts as $post){
            $post->setAttribute('added' , Carbon::parse($post->created_at)->diffForHumans());
            
            $ext = explode('.',$post->photo);
            if(end($ext)!='jpg' && end($ext)!='jpeg' && end($ext)!='png' && end($ext)!='svg'){
                $post->setAttribute('pathVideo' , asset('storage/'.$post->photo));
            }else{
                $post->setAttribute('pathVideo' , asset('storage/'));
            }

            if(end($ext)=='jpg' || end($ext)=='jpeg' || end($ext)=='png' || end($ext)=='svg'){
                $post->setAttribute('path' , asset('storage/'.$post->photo));
            }else{
                $post->setAttribute('path' , asset('storage/'));
            }
        }

        return response()->json($posts);
    }

    /**
     * Display a listing of 4 the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastPost()
    {
        $posts = Post::orderBy("id", "desc")->take(4)->get();
        foreach($posts as $post){
            $ext = explode('.',$post->photo);
            if(end($ext)!='jpg' && end($ext)!='jpeg' && end($ext)!='png' && end($ext)!='svg'){
                $post->setAttribute('pathVideo' , asset('storage/'.$post->photo));
            }else{
                $post->setAttribute('pathVideo' , asset('storage/'));
            }

            if(end($ext)=='jpg' || end($ext)=='jpeg' || end($ext)=='png' || end($ext)=='svg'){
                $post->setAttribute('path' , asset('storage/'.$post->photo));
            }else{
                $post->setAttribute('path' , asset('storage/'));
            }
        }
        return response()->json($posts);
    }


    /**
     * Display a listing of 4 the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serchPosts($id)
    {
        $posts =  Post::with('user')->with('comments')->with('likes')->where('category_id' , $id)->get();
        foreach($posts as $post){
            $post->setAttribute('added' , Carbon::parse($post->created_at)->diffForHumans());
            $post->setAttribute('path' , asset('storage/'.$post->photo));
        }
        return response()->json($posts);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $posts = Category::all();
        return response()->json($posts);
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
        if($request->file('image')){

            $image = $request->file('image')->store('images','public');
    
            $post = Post::create([
                    'title' => $request->input('title'),
                    'body' => $request->input('body'),
                    'slug' => $request->input('title'),
                    'user_id' => $request->input('user_id'),
                    'category_id' => $request->input('category_id'),
                    'photo' => $image,
            ]);
            
            $post->save();
        }else{
            $post = Post::create([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'slug' => $request->input('title'),
                'user_id' => $request->input('user_id'),
                'category_id' => $request->input('category_id'),
                'photo' => '',
        ]);
        
        $post->save(); 
        }

        return Redirect::back();
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyUser(Request $request)
    {
        $users = User::find($request->id);
        User::destroy($users->id);
        $post = Post::where('user_id' , $request->id)->first();
        Post::destroy($post->id);
        return response()->json(['status' => 'deleted']);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyPost(Request $request)
    {
        $post = Post::find($request->id);
        Post::destroy($post->id);
        $post = Comment::where('post_id' , $request->id)->get();
        Comment::destroy($post->id);
        return response()->json(['status' => 'deleted']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyCommit(Request $request)
    {
        $commit = Comment::find($request->id);
        Comment::destroy($commit->id);
        return response()->json(['status' => 'deleted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('user')->with('likes')->where('id' , $id)->with('comments')->orderBy('id', 'desc')->get();
        foreach($post as $Ispost){
            $Ispost->setAttribute('added' , Carbon::parse($Ispost->created_at)->diffForHumans());
            $ext = explode('.',$Ispost->photo);
            if(end($ext)!='jpg' && end($ext)!='jpeg' && end($ext)!='png' && end($ext)!='svg'){
                $Ispost->setAttribute('pathVideo' , asset('storage/'.$Ispost->photo));
            }else{
                $Ispost->setAttribute('pathVideo' , asset('storage/'));
            }

            if(end($ext)=='jpg' || end($ext)=='jpeg' || end($ext)=='png' || end($ext)=='svg'){
                $Ispost->setAttribute('path' , asset('storage/'.$Ispost->photo));
            }else{
                $Ispost->setAttribute('path' , asset('storage/'));
            }

            foreach($Ispost->comments as $ourComments){
                $ourComments->setAttribute('added' , Carbon::parse($ourComments->created_at)->diffForHumans());
                $user =  User::find($ourComments->user_id);
                $ourComments->setAttribute('username' ,$user->name);

            }
        }
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request)
    {
        $user = User::find($request->user_id);
        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $user->id,
        ]);

        $comment->save();

        return response()->json([
            'comment' => $request->comment,
            'added' => Carbon::parse($comment->created_at)->diffForHumans(),
            'username' => $user->name,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addLike(Request $request)
    {
        $like = Like::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
        ]);

        $like->save();

        return response()->json(['status' => 'inserted']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disLike(Request $request)
    {
        $like = Like::where('user_id' , $request->user_id)->where('post_id' , $request->post_id)->get();
        Like::destroy($like[0]->id);
        return response()->json(['status' => 'is deleted']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
