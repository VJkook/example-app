<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class PostsController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function index()
    {
        $response = ['msg' => 'ok'];
        return response()->json($response);
    }

    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        $request->fulfill();

        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
