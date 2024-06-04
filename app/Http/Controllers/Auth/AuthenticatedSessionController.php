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
        
        // $admin = Auth::guard('admin')->user();
        $user = Auth::user();
        // $user = Auth::user();

      
$now = Carbon::now('Asia/Manila');

// Check if there is an existing login history record for today
// if (auth()->check()) {
//     $user = auth()->user();
//     $now = now();
//     $loginHistory = $user->loginHistories()->where('date', $now->toDateString())->first();


// if ($loginHistory) {
//     // If an existing record is found and it's for the current date, update its logout time
//     $loginHistory->update([
//         'logout_time' => $now->toTimeString(),
//     ]);
// } else if($loginHistory) {
    
//     $loginHistory->update([
//         'login_time' => $now->toTimeString(),
//     ]);
// }else{
//     // If no existing record is found, create a new one
//     LoginHistory::create([
//         'user_id' => $user->id,
//         'date' => $now->toDateString(),
//         'login_time' => $now->toTimeString(),
//     ]);
// }
// }

if (Auth::guard('admin')->check()) {
    Auth::guard('admin')->user();

    // Redirect based on the admin usertype
    
        return redirect('admin/dashboard');
    
} else {
    // Check if the web guard is authenticated
    $user = Auth::user();

    // // Redirect based on the user usertype
    if ($user->usertype === 'user') {
        return redirect('dashboard');
    }

    if ($user->usertype === 'systemadmin') {
        return redirect('systemadmin/dashboard');
    }

    // Default user redirection
    
}

       

     

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    

    public function destroy(Request $request): RedirectResponse
    {


        $now = Carbon::now('Asia/Manila');
        // $userId = Auth::id();
        
       
            // Check if there is an existing login history record for today
            if (auth()->check()) {
                $user = auth()->user();
                $now = now();
                $loginHistory = $user->loginHistories()->where('date', $now->toDateString())->first();
            
        
            // Update the logout time if a login history record exists
            if ($loginHistory) {
                $loginHistory->update([
                    // 'user_id' => $userId,
                    // 'date' => $now->toDateString(),
                    'logout_time' => $now->toTimeString(),
                ]);
            } 
        
            
    
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
       

        return redirect('/');
    }
}
}