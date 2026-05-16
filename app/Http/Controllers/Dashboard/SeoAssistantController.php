<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SeoAssistant;
use Illuminate\Http\Request;

class SeoAssistantController extends Controller
{
    public function index()
    {
        $this->authorize('seo_assistants.view');

        $seo = SeoAssistant::first();

        return view('Dashboard.SeoAssistant.index', compact('seo'));
    }

    public function edit()
    {
        $this->authorize('seo_assistants.edit');

        $seo = SeoAssistant::first();

        return view('Dashboard.SeoAssistant.edit', compact('seo'));
    }

    public function update(Request $request)
    {
        $this->authorize('seo_assistants.edit');

        $pages = ['home', 'about', 'contact', 'blogs', 'services', 'products', 'projects', 'categories'];
        $langs = ['en', 'ar'];
        $rules = [];
        foreach ($pages as $page) {
            foreach ($langs as $lang) {
                $rules["{$page}_meta_title_{$lang}"] = 'nullable|string|max:255';
                $rules["{$page}_meta_desc_{$lang}"] = 'nullable|string|max:500';
                if (in_array($page, ['home', 'about', 'contact', 'blogs', 'services', 'products', 'projects', 'categories'])) {
                    $rules["{$page}_index"] = 'nullable|boolean';
                }
            }
        }

        $request->validate($rules);

        $seo = SeoAssistant::first();

        if (! $seo) {
            $seo = new SeoAssistant;
        }

        $seo->fill($request->only(array_keys($rules)));
        // Set index fields to false if not present in the request
        foreach ($pages as $page) {
            if (in_array($page, ['home', 'about', 'contact', 'blogs', 'services', 'products', 'projects', 'categories'])) {
                if (! $request->has("{$page}_index")) {
                    $seo->{"{$page}_index"} = false;
                }
            }
        }
        $seo->save();

        return redirect()->route('dashboard.seo-assistants.index')
            ->with('success', __('dashboard.seo_assistant_updated_successfully'));
    }
}
