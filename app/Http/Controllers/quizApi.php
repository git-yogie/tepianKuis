<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class quizApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$quiz)
    {
        $user = $request->attributes->get("valid_user");
        
        return Quiz::with("soal")->where("user_id",$user->id)->where("kuis_code",$quiz)->first();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function saveAnswer(Request $request)
    {
        return response($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
