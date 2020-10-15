<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\CreateBlogMailEvent;
use App\Events\PublishMailEvent;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = DB::table('blogs')->get();
        return $blogs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        // untuk validasi form
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            
        ]);
        // insert data ke table books
        $blog=Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'publish_status' =>0,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
            
        ]);
        event(new CreateBlogMailEvent($blog));
        return 'Data sukses disimpan';
        
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
    public function update($id){
        $blog=Blog::find($id);
      
        if($blog->publish_status==1){
            $update=0;
        }else{
            $update=1;
        }

        $blog->update([
            'publish_status'=>$update
        ]);
        event(new PublishMailEvent($blog));
        return $blog;
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
