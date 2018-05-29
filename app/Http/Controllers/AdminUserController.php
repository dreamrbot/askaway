<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;

class AdminUserController extends Controller
{
    public function index()
    {
      $user = User::all();

      return View::make('users.index', ['users' => $user]);
    }
}
