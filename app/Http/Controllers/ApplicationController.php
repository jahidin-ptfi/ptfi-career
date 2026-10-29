<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApplicationController extends Controller
{
    public function index()
    {
        $user = User::with([
            'profile',
            'applications.jobListing',
            'educations',
            'experiences',
            'courses',
            'skills',
            'emergencyContacts',
            'families',
            'documents'
        ])->find(Auth::id());

        $applications = $user->applications()->with('jobListing')->orderBy('applied_at', 'desc')->get();

        return view('public.profile.applications', compact('user', 'applications'));
    }
}
