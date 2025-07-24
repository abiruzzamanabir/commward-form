<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nomination;
use Illuminate\Http\Request;

class NominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Nomination = Nomination::all();
        if (count($Nomination) > 0) {
            return response()->json($Nomination, 200);
        } else {
            return response()->json([
                'message' => "Nomination Not Found!"
            ], 404);
        }
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
     * @param  \App\Models\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function show(Nomination $nomination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nomination $nomination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nomination $nomination)
    {
        //
    }
}
