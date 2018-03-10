<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Feedback;
use Mail;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyMail;
 
class FeedbackController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        // not in use
        // uses RegisterController instead
        $feedback = Feedback::create($request->all());
        return response()->json($feedback, 201);
    }

}