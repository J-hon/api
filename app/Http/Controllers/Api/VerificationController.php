<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mark the authenticated user’s email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function verify(Request $request) {
//        auth()->loginUsingId($request->route('id'));

        $user = User::findOrFail($request->route('id'));
        Auth::login($user);

        if ($request->route('id') != $request->user()->getKey())
        {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail())
        {
            return response(['message' => 'Already verified!']);
        }

        if ($request->user()->markEmailAsVerified())
        {
            event(new Verified($request->user()));
        }

        return response()->json(['message' => 'Email verified!'], 200);
    }
    /**
     * Resend the email verification notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail())
        {
            return response()->json(['message' => 'Already verified!'], 422);
        }

        $request->user()->sendEmailVerificationNotification();

        if ($request->wantsJson())
        {
            return response()->json(['message' => 'Email Sent!']);
        }

        return back()->with('resent', true);
    }
}
