<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $featuredSkills = \App\Models\Skill::where('is_featured', true)
            ->orderByDesc('avg_rating')
            ->take(6)
            ->get();
        $latestSkills = \App\Models\Skill::latest()->take(4)->get();
        $stats = [
            'tested_count' => \App\Models\Skill::count(),
            'featured_count' => \App\Models\Skill::where('is_featured', true)->count(),
        ];

        return view('home', compact('featuredSkills', 'latestSkills', 'stats'));
    }
}
