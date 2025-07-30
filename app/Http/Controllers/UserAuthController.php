<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller {
  function signup(Request $request) {
    $password = bcrypt($request->password);

    $newUser           = new User();
    $newUser->name     = $request->name;
    $newUser->email    = $request->email;
    $newUser->password = $password;
    $newUser->save();

    $token = $newUser->createToken('myTokenName')->plainTextToken;

    return [
      'success' => true,
      'user'    => $newUser,
      'token'   => $token,
    ];
  }

  function login(Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
      return [
        'success' => false,
        'message' => 'Email or Password not Matched',
      ];
    }

    $token = $user->createToken('myTokenName')->plainTextToken;

    return [
      'success' => true,
      'user'    => $user,
      'token'   => $token,
    ];
  }
}
