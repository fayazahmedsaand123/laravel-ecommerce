<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardProduct;
use App\Services\CartProductService;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller {
    protected $cartProductService;
    public function __construct(CartProductService $cartProductService) {
        $this->cartProductService = $cartProductService;
    }
    // ============= Product list ============ //
    public function index() {
        $products = CardProduct::all();
        return view('customer.index', compact('products'));
    }
    // ================ Add Cart =============== //
    public function addCart(Request $request) {
        // 1️⃣ SAVE PRODUCT (SERVICE CALL)
        $this->cartProductService->addToCart(
            $request->product_id,
            $request->quantity ?? 1
        );

            // 2️⃣ GET UPDATED CART FROM SESSION
        $cart = session()->get('cart', []);

                // 3️⃣ COUNT TOTAL QUANTITY
        $cartCount = array_sum(array_column($cart, 'quantity'));

                // 4️⃣ RETURN COUNT TO AJAX
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'cart_count' => $cartCount
        ]);
    }
  
    // public function addCart(Request $request) {
    //     $this->cartProductService->addToCart(
    //         $request->product_id,
    //         $request->quantity ?? 1
    //     );
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Product added to cart successfully!'
    //     ]);

    // }

    // ================= View Cart ================= //
    public function viewCart() {
        $cart = $this->cartProductService->getCart();
        $grandTotal = $this->cartProductService->getGrandTotal();
        return view('customer.cart', compact('cart', 'grandTotal'));
    }
    
    // ================= Update Cart ================= //
    public function CartUpdate(Request $request, $key) {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid quantity!'
            ]);
        }

        $this->cartProductService->updateQuantity($key, $request->quantity);

        $cart      = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        $price    = $cart[$key]['price'] ?? 0;
        $newTotal = $price * $request->quantity;

        return response()->json([
            'success'    => true,
            'message'    => 'Cart updated successfully',
            'cart_count' => $cartCount,
            'new_total'  => number_format($newTotal, 2)
        ]);
    }

    // ================== Delete Cart ================ //
    public function CartDelete($key) {
        $this->cartProductService->removeItem($key);

        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success'    => true,
            'message'    => 'Item removed from cart successfully!',
            'cart_count' => $cartCount
        ]);
    }

    // ================== Delete All Cart ================ //
    public function DeleteAllCart() {
        $this->cartProductService->clearCart();

        return response()->json([
            'success'    => true,
            'message'    => 'Cart cleared successfully!',
            'cart_count' => 0
        ]);
    }
    
    // ============= View Cart ============== //
    public function viewProductCart($id) {
        $product = CardProduct::findOrFail($id);
        return view('customer.view_cart', compact('product'));
    }
}
