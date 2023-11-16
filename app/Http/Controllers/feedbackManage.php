<?php

namespace App\Http\Controllers;

use App\Models\feedbackCenter;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class feedbackManage extends Controller
{
    public function index()
    {
        return view('dashboard.admin.feedback.index', [
            'user' => User::where('id', auth()->user()->id)->get()[0],
            'data' => feedbackCenter::with('users_id', 'progres_by')->paginate(15),
        ]);
    }

    public function detail()
    {
        // return  feedbackCenter::where('id', request()->id)
        // ->with('users_id', 'progres_by')
        // ->get();
        return view('dashboard.admin.feedback.layouts.detail_feedback',[
            'user' => User::where('id', auth()->user()->id),
            'data' => feedbackCenter::where('id', request()->id)
                                    ->with('users_id', 'progres_by')
                                    ->get()
        ]);
    }
}
