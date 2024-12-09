<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;



class RegisteredUserController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view("auth/register");

    }

    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            "name" => ["required"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed", Password::min(6)]
        ]);

        $employerAttributes = $request->validate([
            "employer" => ["required"],
            "logo" => ["required", File::types(["png", "jpg", "webp"])]
        ]);

        $logosPath = $request->logo->store("logos");

        $user = User::create($userAttributes);

        // Employer::create([
        //     "name" => $employerAttributes["employer"],
        //     "logo" => $logosPath
        // ]);






        $user->employer()->create([
            "name" => $employerAttributes["employer"],
            "logo" => $logosPath

        ]);

        Auth::login($user);


        return redirect("/");


    }
}


