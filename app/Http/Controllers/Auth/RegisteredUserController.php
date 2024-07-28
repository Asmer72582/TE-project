<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('_register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class),
                function ($attribute, $value, $fail) {
                    // Extract the role from the request
                    $role = request('role');

                    // Define the allowed email domain based on the role
                    $allowedDomain = ($role === 'student') ? 'git-india.edu.in' : 'git-india.edu.in';

                    // Check if the email has the correct domain
                    if (!Str::endsWith($value, '@' . $allowedDomain)) {
                        $fail("The $attribute must end with the correct domain for the selected role.");
                    }
                },
            ],
            'password' => ['required', Rules\Password::defaults()],
            'group_no' => ['required', 'string'],
            'role' => ['required', 'string'],
            'department' => ['required', 'string'],
        ]);


        if ($request->role === "superadmin") {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'group_no' => "superadmin",
                'user_type' => $request->role,
                'department' => $request->department
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'group_no' => $request->group_no,
                'user_type' => $request->role,
                'department' => $request->department
            ]);
        }




        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
