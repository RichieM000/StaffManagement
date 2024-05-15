<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // $user = Auth::user();

        // $now = Carbon::now('Asia/Manila');
        // LoginHistory::create([
        //     'user_id' => $user->id,
        //     'date' => $now->toDateString(),
        //     'login_time' => $now->toTimeString(),
        // ]);

        if($request->user()->usertype === 'admin'){
            return redirect('admin/dashboard');
        }

        if($request->user()->usertype === 'systemadmin'){
            return redirect('systemadmin/dashboard');
        }

     

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {


        // $now = Carbon::now('Asia/Manila');
        // // $userId = Auth::id();
        
       
        //     // Check if there is an existing login history record for today
        //     $loginHistory = auth()->user()->loginHistories()->where('date', Carbon::today())->first();
        
        //     // Update the logout time if a login history record exists
        //     if ($loginHistory) {
        //         $loginHistory->update([
        //             // 'user_id' => $userId,
        //             // 'date' => $now->toDateString(),
        //             'logout_time' => $now->toTimeString(),
        //         ]);
        //     } 
        

    
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
       

        return redirect('/');
    }
}
