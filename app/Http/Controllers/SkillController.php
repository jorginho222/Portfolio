<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    public function index()
    {
        return Inertia::render('Skills/All', [
            'skills' => Skill::all(),
            'availableColors' => Skill::getAvailableTextColors(),
            'availableIcons' => Skill::getAvailableIcons(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique(Skill::class)
            ],
            'color' => [
                'required',
                'in:' . implode(',', Skill::getAvailableTextColors()), // Tiene que ser uno de esos colores del array (available colors) separados por una coma. 
            ],
            'icon_name' => [
                'required',
                'in:' . implode(',', Skill::getAvailableIcons()), // Tiene que ser uno de esos iconos del array (available icons) separados por una coma. 
            ]
        ]);

        Skill::create($request->all());

        return redirect()->route('skills.index');
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique(Skill::class)->ignore($skill->id),
            ],
            'color' => [
                'required',
                'in:' . implode(',', Skill::getAvailableTextColors()), // Tiene que ser uno de esos colores del array (available colors) separados por una coma. 
            ],
            'icon_name' => [
                'required',
                'in:' . implode(',', Skill::getAvailableIcons()), // Tiene que ser uno de esos iconos del array (available icons) separados por una coma. 
            ]
        ]);

        $skill->update($request->all());

        return redirect()->route('skills.index');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        
        return redirect()->route('skills.index');
    }
}
