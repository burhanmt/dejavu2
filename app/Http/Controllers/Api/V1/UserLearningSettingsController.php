<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\UserLearningSetting;
use Illuminate\Http\Request;

class UserLearningSettingsController extends Controller
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
     * @param  \App\Models\UserLearningSetting  $userLearningSetting
     * @return \Illuminate\Http\Response
     */
    public function show(UserLearningSetting $userLearningSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserLearningSetting  $userLearningSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserLearningSetting $userLearningSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLearningSetting  $userLearningSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLearningSetting $userLearningSetting)
    {
        //
    }
}
