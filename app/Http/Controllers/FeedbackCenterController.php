<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorefeedbackCenterRequest;
use App\Http\Requests\UpdatefeedbackCenterRequest;
use App\Models\feedbackCenter;

class FeedbackCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.feedback.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefeedbackCenterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(feedbackCenter $feedbackCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(feedbackCenter $feedbackCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefeedbackCenterRequest $request, feedbackCenter $feedbackCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(feedbackCenter $feedbackCenter)
    {
        //
    }
}
