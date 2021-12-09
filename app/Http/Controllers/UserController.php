<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Company;
use App\Models\Prefecture;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('user_emails');
        $company = $user->company;
        $prefectures = Prefecture::get();
        return view('pages.user.create-edit', compact('user', 'company', 'prefectures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $update = $request->password ? ['password' => Hash::make($request->password)] : [];
        $update = $user->finish_onboarding_at ? $update : $update + ['finish_onboarding_at' => now()];
        $user->fill($request->only([
            'login_id',
            'team_name',
            'prefecture_code',
            'description',
            'email',
            'name',
            'kana',
            'tel',
            'sex',
            'age_range',
        ]) + $update)->save();
        $user->company->fill([
            'corporate_number' => $request->company['corporate_number'],
            'name' => $request->company['name'],
        ])->save();

        // 通知先メールアドレスをDELETE&CREATE
        // user_emailsは同一メールは許容（A社の複数ユーザで同じメアドを登録する可能性あるため。例えば監査部署メアドなど。validate実装も煩雑になる。）
        $user->user_emails()->delete();
        foreach ($request->user_emails as $user_email) {
            if (!$user_email) continue;// nullの場合は登録しない。
            $user->user_emails()->create(['email' => $user_email]);
        }
        return redirect('/')->with('success', '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
