<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Http\Response as HttpResponse;
=======
use Illuminate\Http\Response;
>>>>>>> 5ce561131bd41c51bdd004750f39d97847edd8e3
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
<<<<<<< HEAD
    public function store(LoginRequest $request): RedirectResponse | User
=======
    public function store(LoginRequest $request): RedirectResponse|User
>>>>>>> 5ce561131bd41c51bdd004750f39d97847edd8e3
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(request()->wantsJson() || collect(request()->route()->gatherMiddleware())->contains('api')){
            return Auth::user();
        }
<<<<<<< HEAD

=======
>>>>>>> 5ce561131bd41c51bdd004750f39d97847edd8e3
        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
<<<<<<< HEAD
    public function destroy(Request $request): RedirectResponse | Response
=======
    public function destroy(Request $request): RedirectResponse|Response
>>>>>>> 5ce561131bd41c51bdd004750f39d97847edd8e3
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
<<<<<<< HEAD

        if(request()->wantsJson() || collect(request()->route()->gatherMiddleware())->contains('api')){
            return response()->noContent(Response::HTTP_NO_CONTENT);
        }

=======
        if(request()->wantsJson() || collect(request()->route()->gatherMiddleware())->contains('api')){
            return response()->noContent(Response::HTTP_NO_CONTENT);
        }
>>>>>>> 5ce561131bd41c51bdd004750f39d97847edd8e3
        return redirect('/');
    }
}
