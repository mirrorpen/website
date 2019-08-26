<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', [
           'only' => ['create']
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    /*
     * 登录
     *
     * */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember')))
        {
            session()->flash('success', '登录成功！');
            return redirect()->intended(route('users.show', [Auth::user()]));
        }else{
            session()->flash('danger', '邮箱和密码不匹配，请重新输入');
            return redirect()->back();
        }
    }

    /*
     * 登出
     *
     * */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }

}
