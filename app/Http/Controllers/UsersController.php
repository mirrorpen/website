<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index']
        ]);

        $this->middleware('guest', [
           'only' => ['create']
        ]);
    }

    /*
     * 用户列表
     *
     * */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /*
     * 注册页面
     *
     * */
    public function create()
    {
        return view('users.create');
    }

    /*
     * 用户注册
     *
     * */
    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $num = rand(1,5);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => '/avatar/'.$num.'.jpg',
        ]);

        Auth::login($user);
        session()->flash('success', '欢迎成为本站的爸爸！');
        return redirect()->route('users.show',[$user]);
    }

    /*
     * 用户微博展示
     *
     * */
    public function show(User $user)
    {
        $statuses = $user->statuses()->orderByDesc('created_at')->paginate(10);
        return view('users.show', compact('user', 'statuses'));
    }

    /*
     * 用户编辑资料
     *
     * */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password'=>'nullable|confirmed|min:6'
        ]);
        $this->authorize('update', $user);
        $data['name'] = $request->name;
        if ($request->password)
        {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '修改成功！');
        return redirect()->route('users.show',$user->id);
    }

    /*
     * 管理员删除用户
     *
     * */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    public function followings(User $user)
    {
        $users = $user->followings()->paginate(10);
        $title = '关注的人';
        return view('users.show_follow', compact('users','title'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(10);
        $title = '粉丝';
        return view('users.show_follow', compact('users','title'));
    }
}
