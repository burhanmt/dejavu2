<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MemoryLevel;
use Illuminate\Http\Request;

class MemoryLevelsController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemoryLevel  $memoryLevel
     * @return \Illuminate\Http\Response
     */
    public function show(MemoryLevel $memoryLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemoryLevel  $memoryLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemoryLevel $memoryLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemoryLevel  $memoryLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemoryLevel $memoryLevel)
    {
        //
    }
}
