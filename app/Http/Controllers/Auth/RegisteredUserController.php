<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\InvitedCompany;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // 会社の入力チェック（ユーザーの入力チェックにて会社IDが必要なため先に行う）
        $request->validate([
            'corporate_number' => ['required', 'integer', 'digits_between:13,15'],
        ], [], [
            'corporate_number' => '法人番号',
        ]);
        $company = Company::firstOrCreate(['corporate_number' => $request->corporate_number]);

        // ユーザーの入力チェック
        $request->validate([
            'login_id' => ['required', 'string', 'min:6', 'max:255', Rule::unique('users')->where('company_id', $company->id)->whereNull('deleted_at')],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [], [
            'login_id' => 'ログインID',
        ]);

        $user = User::create([
            'company_id' => $company->id,
            'name' => $request->name,
            'login_id' => $request->login_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
