<?php

namespace App\Http\Controllers;

use App\Models\Image;
// use Facade\FlareClient\Http\Response;
// use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        Log::info($request);
        // dd($request);
        if($request->hasFile('image')){
            $url=$request->file('image')->store('images');
        }
        $image=Image::create(
            [
                'url'=>$url,
                'user_id'=>$request->user()->id
            ]
        );
        return response()->json($image->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $images=Image::where('user_id',$id)->get();
        $i=0;
        $path=[];
        // $url=Storage::url($path);
        // $url=[];
        // dd($url);
        // return response()->json($url);
        // return $response;
        foreach($images as $image){
            $path[$i]=$image->only(['url']);
            $i++;
        }
        // return response()->file("storage/app/+$path[0]['url']");
        return response()->json($path);
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
