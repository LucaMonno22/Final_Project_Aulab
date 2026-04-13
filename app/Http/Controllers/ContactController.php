<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.contact');
    }
    public function submit()
    {
        $data = [
            'name'    => request('name'),
            'email'   => request('email'),
            'subject' => request('subject'),
            'message' => request('message'),
        ];

        Mail::to('admin@presto.it')->send(new ContactMail($data));

        // Usa la chiave ui.successMessage
        return redirect()->back()->with('status', __('ui.successMessage'));
    }
}
