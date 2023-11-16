<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorefeedbackCenterRequest;
use App\Http\Requests\UpdatefeedbackCenterRequest;
use App\Models\feedbackCenter;
use App\Helper\DatabaseHelper;
use Illuminate\Support\Str;
class FeedbackCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.feedback.index', [
            'user' => DatabaseHelper::getUser()[0]
        ]);
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
        $validate = request()->validate([
            'kategori' => 'required',
            'deskripsi' => 'required',
            'info_tambahan' => 'max:255',
            'lampiran' => 'file', // Menambahkan validasi bahwa ini adalah sebuah file
        ]);

        $count_feedback = feedbackCenter::count();

        $validate['no_feedback'] = 'OCTNS-FDB-000' . ($count_feedback + 1) . '-' . DatabaseHelper::getYear();

        $validate['user_id'] = auth()->user()->id;

        $deskripsi = strip_tags(request()->deskripsi);
        $validate['excerpt'] = mb_strlen($deskripsi) > 10 ? mb_substr($deskripsi, 0, 50) . '...' : $deskripsi;


        if(request()->hasFile('lampiran') && $validate['lampiran']->isValid()) {
            $validate['lampiran'] = request()->file('lampiran')->storeAs('lampiran-feedback-images', uniqid() . '-' . request()->file('lampiran')->getClientOriginalName());
        }

        feedbackCenter::create($validate);

        return redirect('/feedback')->with('success', 'feedback berhasil dikirim');
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
