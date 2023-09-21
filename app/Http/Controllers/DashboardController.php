<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userRole = auth()->user()->getRoleNameAttribute();

        // redirect to the appropriate dashboard based on the user's role
        switch ($userRole) {
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;
            case 'instructor':
                return redirect()->route('instructor.dashboard');
                break;
            case 'member':
                return redirect()->route('member.dashboard');
                break;
            default:
                return redirect()->route('login');
                break;
        }
    }
}
