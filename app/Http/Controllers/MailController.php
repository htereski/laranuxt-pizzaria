<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function notice()
    {
        return response()->json(['message' => 'This is the email verification endpoint']);
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 200);
        }

        $request->fulfill();

        return response()->json(['message' => 'Email verified successfully'], 200);
    }

    public function send(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 200);
        }

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send verification email'], 500);
        }

        return response()->json(['message' => 'Verification link sent'], 200);
    }
}
