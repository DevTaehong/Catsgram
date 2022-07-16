<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isThemeManager')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::all();

        return view('theme.index', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.create', ['themes' => Theme::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'cdn_url' => 'required',
        ]);

        $data['created_by'] = auth()->user()->id;
        Theme::create($data);


        return redirect('/themes/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        return view('/theme/show', compact('theme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        return view('/theme/edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme)
    {
        $updatedById = auth()->user()->id;
        $theme->update(request()->validate([
            'name' => 'required',
            'cdn_url' => 'required'
        ]));

        $theme->updated_by = $updatedById;
        $theme->save();

        return redirect('/themes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        $deletedById = auth()->user()->id;

        $theme->deleted_by = $deletedById;
        $theme->save();

        $theme->delete();

        return redirect('/themes');
    }

    public function set(Theme $theme) {
        if ($theme->name != "Default") {
            return redirect()->back()->withCookie("theme", $theme->cdn_url);
        } else {
            Cookie::queue(Cookie::forget("theme"));
            return redirect()->back();
        }
    }
}
