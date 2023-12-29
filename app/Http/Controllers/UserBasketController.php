<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use App\Models\UserBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

use Symfony\Component\HttpFoundation\Response;

class UserBasketController extends Controller {
    public function getBasketForUser() {
        $user = Auth::user();
        $basketItems = UserBasket::where('user_id', $user->id)
                            ->where('status', 'pendingTransaction')
                            ->with('moto')
                            ->get();

        return Inertia::render('Basket', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'basketItems' => $basketItems,
        ]);
    }

    public function addToBasket(Moto $moto) {
        $user = Auth::user();
        if (!$user || !$user->id) {
            return response()->json(['error' => "User is not authenticated"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if (!$moto || !$moto->id) {
            return response()->json(['error' => "Invalid moto id", 'id' => $moto], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $moto->status = 'occupied';
        $moto->save();

        $basketItem = UserBasket::create([
            'user_id' => $user->id,
            'moto_id' => $moto->id,
            'quantity' => 1,
            'status' => 'pendingTransaction', 
            'start_date' => now(),
            'end_date' => now(),
            'total_price' => $moto->base_rent_price,
            'total_price_currency' => $moto->base_rent_currency,
        ]);

        return response()->json([
            'message' => 'Moto added to basket',
            'basketItems' => $user->basketItems,
            'debug' => 'Server response is okay',
        ]);
    }

    public function removeFromBasket(Moto $moto) {
        $user = Auth::user();
        if (!$user || !$user->id) {
            return response()->json(['error' => "User is not authenticated"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if (!$moto || !$moto->id) {
            return response()->json(['error' => "Invalid moto id"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $basketItem = UserBasket::where('user_id', $user->id)
                            ->where('moto_id', $moto->id)
                            ->first();

        $moto->status = 'free';
        $moto->save();

        if ($basketItem) {
            $basketItem->delete();
            return response()->json(['message' => 'Moto removed from basket']);
        } else {
            return response()->json(['error' => 'Moto is not found'], 404);
        }
    }
}

