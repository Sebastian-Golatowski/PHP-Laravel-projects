<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = DB::select('SELECT * FROM posts ORDER BY created_at desc');
        // $posts = Post::orderBy('created_at','desc')->take(1)->get();

        $posts = Post::all();
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image'=>'image|nullable|max:1999' 
        ]);
        //File upload
        if($request->hasFile('cover_image')){
            //cały plik
            $uploadedFile= $request->file('cover_image')->getClientOriginalName();
            //sama nazwa
            $fileName=pathinfo($uploadedFile,PATHINFO_FILENAME);
            //rozszerzenie
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            //nowa nazwa
            $fileNameToStore = $fileName.'_'.time().'_'.$extention;
            //ścieszka zapisu do bazy
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            
        }
        else{
            $fileNameToStore='noimage.jpg';
        }
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/home')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //Correct user?
        if(auth()->user()->id == $post->user_id){
            return view('posts.edit')->with('post',$post);
        }
        return redirect('/posts')->with('error','Access Denied');
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
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image'=>'image|nullable|max:1999' 
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){

            //cały plik
            $uploadedFile= $request->file('cover_image')->getClientOriginalName();
            //sama nazwa
            $fileName=pathinfo($uploadedFile,PATHINFO_FILENAME);
            //rozszerzenie
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            //nowa nazwa
            $fileNameToStore = $fileName.'_'.time().'_'.$extention;
            //ścieszka zapisu do bazy
            Storage::delete('public/cover_images/'.$post->cover_image);
            $post->cover_image = $fileNameToStore;
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        if($request->input('dashboard')){
            Storage::delete('public/cover_images/'.$post->cover_image);
            return redirect('/home')->with('success','Post Deleted');
        }
        if(auth()->user()->id == $post->user_id){
            Storage::delete('public/cover_images/'.$post->cover_image);
            return redirect('/posts')->with('success','Post Deleted');
        }
        return redirect('/posts')->with('error','Access Denied');
    }
}
