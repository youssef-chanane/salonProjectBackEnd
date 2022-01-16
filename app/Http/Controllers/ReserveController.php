<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'user_id' => 'required',
        ]);

        $reservation = Reserve::create([
            'name'=>$request->name,
            'user_id'=>$request->user_id,
        ]);

        return response()->json($reservation);
    }
    public function show($id)
    {
        $reservations=Reserve::where('user_id',$id)->get();
        return response()->json($reservations);
    }
    public function destroy($id)
    {
        $user_id=Reserve::find($id)->user_id;
        $res=Reserve::destroy($id);
        return response()->json($user_id);
    }
}
