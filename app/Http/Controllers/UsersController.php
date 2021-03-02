<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateCategoryRequest;
use App\Http\Requests\Users\UsersUpdateRequest;

class UsersController extends Controller
{
    public function index()
    {
      $users = User::all();
      return view('users.index')->with('users', $users);
    }

    public function makeAdmin(User $user)
    {
      $user->role = 'admin';
      $user->save();
      session()->flash('success', '権限が付与されました。');
      return redirect(route('users.index'));
    }

    // public function edit($userId)
    // {
    //   $user = User::find($userId);
    //   return view('users.edit')->with('user', $user);
    // }

    public function edit()
    {
      return view('users.edit')->with('user', auth()->user());
      //モデルバインディングで$userを使ったら、userの情報を取得できない。つまり、auth()で認証しているuserしか操作できない？ようになっている。
    }

    public function update(UsersUpdateRequest $request)
    {
      $user = auth()->user();
      //こっちもeditと同様モデルバインディングではデータが更新されない。
      $user->update([
        'name' => $request->name,
        'about' => $request->about
      ]);
      session()->flash('success', 'User updated successfully.');
      return redirect()->back();

      // $user = User::find($request->id);
      // $user->name = $request->name;
      // $user->about = $request->about;

      // $user->update();

      // return redirect(route('users.index'));
    }
}
