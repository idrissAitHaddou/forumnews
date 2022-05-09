<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
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
        $posts = Post::with('user')->with('comments')->with('likes')->get();

        foreach($posts as $post){
            $post->setAttribute('added' , Carbon::parse($post->created_at)->diffForHumans());
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
        $posts = Post::take(4)->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('user')->with('comments')->with('likes')->where('id' , $id)->get();
        foreach($post as $Ispost){
            $Ispost->setAttribute('added' , Carbon::parse($Ispost->created_at)->diffForHumans());
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
        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $request->post_id
        ]);

        $comment->save();

        return response()->json(['status' => 'is added']);
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
