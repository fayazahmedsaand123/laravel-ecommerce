<?php

namespace App\Services;

use App\Models\CardProduct;


class CartProductService {

    // ============== Add Cart ================= //
    public function addToCart($productId, $quantity) {
        $product = CardProduct::findOrFail($productId);
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } 
        else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'description' => $product->description,
                'seller_id' => $product->user_id, // ⭐ IMPORTANT

            ];
        }
        session()->put('cart', $cart);
    }
    
    // =============== Update Quantity ================ //
    public function updateQuantity($id, $quantity) {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
    }
    // ================== Remove Item ===================== //
    public function removeItem($id) {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    // ================== Clear All Cart ===================== //
    public function clearCart() {
        session()->forget('cart');
    }

    // =================== Grand Total ========================= //
    public function getGrandTotal() {
        $total = 0;
        foreach ($this->getCart() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    // =================== Get Cart ========================= //
    public function getCart() {
        return session()->get('cart', []);
    }
}
