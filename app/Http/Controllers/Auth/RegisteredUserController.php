<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\Address;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'info' => [
                'countries' => Country::all(),
            ],
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|string|unique:users|max:15',
            'password' => 'required|string|min:6',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country_id' => 'required|int|max:255',
        ];
        $messages = [
            'email.unique' => 'Этот адрес электронной почты уже зарегистрирован.',
            'phone.unique' => 'Этот номер телефона уже зарегистрирован.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // Создаем или находим адрес
        $address = Address::firstOrCreate([
            'country_id' => $request->input('country_id'),
            'street' => $request->input('street'),
            'house_number' => $request->input('house_number'),
            'zip_code' => $request->input('zip_code'),
            'city' => $request->input('city'),
        ]);

        // Создаем пользователя
        $user = User::create([
            'address_id' => $address->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
        ]);

        try {
            // ваш существующий код
            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
