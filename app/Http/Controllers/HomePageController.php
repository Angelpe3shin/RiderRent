<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Moto;
use App\Models\UserBasket;

class HomePageController extends Controller {
    public function index() {
        $userData = [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'motos' => Moto::with('motoModel', 'color')->get()->toArray(),
        ];
        // Проверяем, залогинен ли пользователь
        if (Auth::check()) {
            // Получаем корзину пользователя, если он залогинен
            $user = Auth::user();
            $basketItems = UserBasket::where('user_id', $user->id)->get()->toArray();

            // Добавляем данные корзины в массив данных для передачи в Inertia
            $userData['basketItems'] = $basketItems;
        }

        return Inertia::render('HomePage', $userData);
    }
}
