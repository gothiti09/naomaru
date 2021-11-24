<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class UserCurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curricula = Curriculum::get();
        return view('pages.user-curriculum.index', compact('curricula'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curriculum = new Curriculum();
        return view('pages.user-curriculum.show', compact('curriculum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurriculumRequest $request)
    {
        $curriculum = Curriculum::create($request->all());
        return redirect(route('manage.curriculum.edit', $curriculum->id))->with('success', '登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function show(Curriculum $curriculum)
    {
        $curriculum->load(['questions' => function ($query) {
            $query->whereNotNull('answer')->orderBy('displayorder');
        }]);
        return view('pages.user-curriculum.show', compact('curriculum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function edit(Curriculum $curriculum)
    {
        return view('pages.curriculum.create-edit', compact('curriculum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curriculum $curriculum)
    {
        $curriculum->fill($request->all())->save();
        return redirect(route('manage.curriculum.edit', $curriculum->id))->with('success', '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curriculum $curriculum)
    {
        //
    }
}
