<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function create()
    {
        return view('portfolio.create');
    }

    public function store(Request $request)
    {
    $data = $request->validate([
        'full_name' => 'required|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'email' => 'required|email',
        'contact_number' => 'nullable|string|max:50',
        'address' => 'nullable|string',
        'about_me' => 'nullable|string',
        'education' => 'nullable|string',
        'skills' => 'nullable|string',
        'projects' => 'nullable|string',
        'work_experience' => 'nullable|string',
        'social_links' => 'nullable|string',
    ]);

    if ($request->hasFile('profile_picture')) {
        $data['profile_picture'] = $request->file('profile_picture')
            ->store('profile-pictures', 'public');
    }

    $portfolio = Portfolio::create($data);

    return redirect()->route('portfolio.choose-template', $portfolio->id);
    }

    public function selectTemplate(Request $request, $id)
    {
    $portfolio = Portfolio::findOrFail($id);

    $request->validate([
        'template' => 'required|in:template1,template2,template3',
    ]);

    $portfolio->update([
        'template' => $request->template,
    ]);

    return redirect()->route('portfolio.show', $portfolio->id);
    }

    public function chooseTemplate($id)
    {
    $portfolio = Portfolio::findOrFail($id);
    return view('portfolio.choose-template', compact('portfolio'));
    }

    public function show($id)
    {
    $portfolio = Portfolio::findOrFail($id);

    return view(
        'portfolio.templates.' . $portfolio->template,
        compact('portfolio')
    );
    }

    public function edit($id)
    {
    $portfolio = Portfolio::findOrFail($id);

    return view('portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
    $portfolio = Portfolio::findOrFail($id);

    $data = $request->validate([
        'full_name' => 'required|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'email' => 'required|email',
        'contact_number' => 'nullable|string|max:50',
        'address' => 'nullable|string',
        'about_me' => 'nullable|string',
        'education' => 'nullable|string',
        'skills' => 'nullable|string',
        'projects' => 'nullable|string',
        'work_experience' => 'nullable|string',
        'social_links' => 'nullable|string',
    ]);

    if ($request->hasFile('profile_picture')) {
        $data['profile_picture'] = $request->file('profile_picture')
            ->store('profile-pictures', 'public');
    }

    $portfolio->update($data);

    return redirect()->route('portfolio.show', $portfolio->id);
    }

    public function destroy($id)
    {
    $portfolio = Portfolio::findOrFail($id);

    $portfolio->delete();

    return redirect()->route('portfolio.create');
    }

}