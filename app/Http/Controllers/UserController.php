<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function home()
  {
    return view('user.content.home');
  }

  public function login()
  {
    if (Auth::check()) {
      return redirect(route('user.home'));
    }
    return view('user.content.login');
  }

  public function register()
  {

    if (Auth::check()) {
      return redirect(route('user.home'));
    }
    return view('user.content.register');
  }

  public function loginStore(Request $request)
  {
    $request->validate([
      'email' => 'required',
      'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      return redirect()->intended(route('user.home'));
    }
    return redirect()->back()->with("error", "Login details are not valid");
  }

  public function registerStore(Request $request)
  {
    $message = ['email.regex' => 'Please put a valid email e.g. gmail or yahoo'];
    $validator = Validator::make($request->all(), [
      'username' => 'required|max:20|unique:users',
      'email' => ['required', 'email', 'unique:users', 'regex:/gmail|yahoo/'],
      'password' => 'required|min:5',
    ], $message);

    if ($validator->fails()) {
      return response()->json([
        'status' => 400,
        'errors' => $validator->messages()
      ]);
    } else {
      $data = new User();
      $data->username = $request->username;
      $data->email = $request->email;
      $data->password = Hash::make($request->password);
      $data->password_string = $request->password;
      $data->save();
      return response()->json([
        'status' => 200,
        'message' => 'Congratulation You Register Successfully! Now You can Login.'
      ]);
    }
  }

  public function userProfile()
  {
    $id = Auth::user()->id;
    $user = auth()->user();
    $users = User::find($id);
    return view('user.content.user_profile', compact('users'));
  }

  public function profileEdit($id)
  {
      $user = User::find($id);
      if($user)
      {
          return view('user.content.profile_edit', compact('user'));
      }
  }

  public function profileUpdate(Request $request, $id)
  {
    $message = ['email.regex' => 'Please put a valid email e.g. gmail or yahoo'];
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'email' => ['required', 'email', 'regex:/gmail|yahoo/'],
      'password' => 'required|min:5',
    ], $message);

    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'errors' => $validator->messages()
        ]);
    } else {
        $data = User::find($id);
        if ($data) {

          $data->username = $request->username;
          $data->email = $request->email;
          $data->password = Hash::make($request->password);
          $data->password_string = $request->password;
            $data->update();
            return response()->json([
                'status' => 200,
                'message' => 'Your Data Updated Successfully. Click on View Button to See Updated Prfile.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found.'
            ]);
        }
    }
}

public function profileDestroy($id)
{
    $user = User::find($id);
        $user->delete();
        return response()->json([
          'status' => 200,
          'message' => 'You account is deleted. Create a new one to perform actions. Now You will redirect to Registration page'
      ]);
}
    
  public function logOut()
  {
    Auth::logout();
    return redirect(route('user.home'));
  }
}
