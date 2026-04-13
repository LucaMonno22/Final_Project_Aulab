<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_accepted', true)->orderBy('created_at', 'desc')->take(6)->get();
        return view('announcements.index', compact('announcements'));
    }

    public function setLanguage($lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }

    public function orders()
    {
        // Recupera solo gli ordini di chi è loggato
        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->get();

        return view('user.orders', compact('orders'));
    }
}
