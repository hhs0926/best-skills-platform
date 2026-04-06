<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // 获取用户统计数据
        $stats = [
            'total_skills' => \App\Models\Skill::count(),
            'total_posts' => \App\Models\Post::count(),
            'total_exchanges' => \App\Models\SkillExchange::where('user_id', $user->id)->count(),
            'user_likes' => \App\Models\Like::where('user_id', $user->id)->count(),
        ];

        // 获取最新Skills
        $recentSkills = \App\Models\Skill::latest()->take(4)->get();

        return view('dashboard.index', compact('stats', 'recentSkills'));
    }
}
