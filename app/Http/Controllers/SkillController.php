<?php

namespace App\Http\Controllers;

use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $category = request('category', 'all');
        $search = request('search', '');

        $query = Skill::query();

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_desc', 'like', "%{$search}%");
            });
        }

        $skills = $query->orderByDesc('is_featured')->orderByDesc('avg_rating')->get();
        $categories = [
            'all' => '全部',
            'discovery' => '🔍 发现',
            'development' => '💻 开发',
            'design' => '🎨 设计',
            'productivity' => '⚡ 效率',
            'automation' => '🤖 自动化',
            'creative' => '✨ 创作',
            'devops' => '🐳 运维',
            'security' => '🛡️ 安全',
        ];
        $featuredSkills = Skill::where('is_featured', true)->take(4)->get();

        return view('skills.index', compact('skills', 'categories', 'category', 'search', 'featuredSkills'));
    }

    public function show(Skill $skill)
    {
        $relatedSkills = Skill::where('category', $skill->category)
            ->where('id', '!=', $skill->id)
            ->take(3)
            ->get();

        return view('skills.show', compact('skill', 'relatedSkills'));
    }
}
