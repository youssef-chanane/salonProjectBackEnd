<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Salon;

class SalonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store','update','destroy']);
    }
    public function addlike($id){
        $salon=Salon::find($id);
        $salon->likes=$salon->likes+1;
        $salon->save();
        return response()->json($salon);
    }
    public function deletelike($id){
        $salon=Salon::find($id);
        $salon->likes=$salon->likes-1;
        $salon->save();
        return response()->json($salon);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salons=Salon::orderBy("likes","desc")->get();
        return response()->json($salons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'salon_name' => 'required|string',
            'nb_barber' => 'required',
            'phone' => 'required',
        ]);

        $salon = Salon::create([
            'salon_name'=>$request->salon_name,
            'nb_barber'=>$request->nb_barber,
            'phone'=>$request->phone,
            'user_id'=>$request->user()->id,
        ]);

        return response()->json($salon);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //show using user id
    public function show($id)
    {
        // $salon=Salon::where('user_id',$id)->first();
        // return response()->json($salon);


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

        $salon=Salon::find($id);
        // $this->authorize('update',$salon);
        $salon->update($request->all());
        $salon->save();
        return response()->json($salon);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Salon::find($id));
        Salon::destroy($id);
        return response()->json();

    }
}
