<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\VerifyAdmins;
use App\Models\User;
use App\Queries\SearchUsers;
use Illuminate\Auth\Middleware\Authenticate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class, VerifyAdmins::class]);
    }

    public function index()
    {
        $search = request('search');
        $users = $search ? SearchUsers::get($search) : User::findAllPaginated();

        return view('admin.overview', compact('users', 'search'));
    }
}
