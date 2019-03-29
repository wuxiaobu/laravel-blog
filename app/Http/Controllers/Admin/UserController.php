<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserController extends Controller
{
    // Auth验证登录
    public function login(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('pass');

        if(Auth::attempt(['email'=>$email, 'password'=>$pass], $request->filled('remember'))) {
            $user = Auth::user();
            $data = array(
                'status' => 200,
                'message' => '登录成功',
                'user' => array(
                    'name' => $user['name'],
                )
            );
        }else {
            $data = array(
                'status' => 422,
                'message' => '用户名或密码不正确',
            );
        }

        return response()->json($data);
    }

    // Auth验证当前登录用户
    public function checkUser()
    {
        return Auth::check() ? 0 : 1;
    }

    // 退出登录
    public function logout()
    {
        Auth::logout();
        return response()->json(array('status' => 0, 'message' => '退出成功'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, array(
            'pass' =>  'required|confirmed|min:8',
            'pass_confirmation' => 'required|min:8'
        ));

        $result = $request->user()->fill(array(
            'password' => Hash::make($request->input('pass'))
        ))->save();

        if($result) {
            Auth::logout();
            return response()->json(array(
                'status' => 0,
                'message' => '修改成功'
            ));
        }else {
            return response()->json(array(
                'status' => 1,
                'message' => '修改失败'
            ));
        }
    }

}
