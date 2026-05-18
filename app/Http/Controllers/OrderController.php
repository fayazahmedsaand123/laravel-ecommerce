<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Customer;
use App\Models\CardProduct;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AddConfirm;
use App\Mail\OrderConfirmMail;
use Carbon\Carbon; 

class OrderController extends Controller {

    // ============ Confirm Form ================ //
    public function ConfirmForm() {
        $cart = session('cart');
        if (!$cart || count($cart) == 0) {
            return redirect()->route('index')->with('fail', 'Your cart is empty.');
        }
        return view('customer.confirm_order', compact('cart'));
    }

    // =============== Place Order =============== //
    public function Place_Order(AddConfirm $request) {
        $cart = session('cart');
        if (!$cart || count($cart) == 0) {
            return redirect()->route('index')->with('fail', 'Your cart is empty.');
        }
        $name           = $request->name;
        $email          = $request->email;
        $phone          = $request->phone;
        $address        = $request->address;
        $payment_method = $request->payment_method;

        $customer = Customer::where('email', $email)->first();

        if (!$customer) {
            $customer = Customer::create([
                'name'           => $name,
                'email'          => $email,
                'phone'          => $phone,
                'address'        => $address,
                'payment_method' => $payment_method,
        ]);
        } 
        else {
            $customer->update([
                'name'           => $name,
                'email'          => $email,
                'phone'          => $phone,
                'address'        => $address,
                'payment_method' => $payment_method,
            ]);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $loginId = session('login_id');

        $order = Order::create([
            'customer_id'    => $customer->id,
            'user_id'        => $loginId,
            'total_amount'   => $total,
            'payment_method' => $payment_method,
            'order_status'   => 'pending',
            'address'        => $address,
        ]);

        foreach ($cart as $productId => $item) {
            $product = CardProduct::find($productId);

            // If the product exists and has a seller, use it. 
            // Otherwise, you might want to assign a default or throw an error.
            $sellerId = $product ? $product->user_id : null;

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'seller_id'  => $sellerId, 
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'subtotal'   => $item['price'] * $item['quantity'],
            ]);
        }
        
        session()->forget('cart');
        session()->put('order_id', $order->id);

        return redirect()->route('order.success');
    }

    // ============ Send OTP ================ //
    public function sendOtp(Request $request) {
        $order    = Order::with('customer')->findOrFail($request->order_id);
        $customer = $order->customer;

        if (!$customer || !$customer->email) {
            return response()->json(['success' => false, 'message' => 'Customer email not found.']);
        }

        $otp = rand(100000, 999999);

        $order->otp            = $otp;
        $order->otp_verified   = false;
        $order->otp_expires_at = Carbon::now()->addMinutes(10);
        $order->save();

        try {
            Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($customer) {
                $message->to($customer->email)
                        ->subject('Your Order OTP Code');
            });

            \Log::info('✅ OTP mail sent to: ' . $customer->email);

            return response()->json(['success' => true, 'message' => 'OTP sent to ' . $customer->email]);

        } catch (\Exception $e) {
            \Log::error('❌ OTP Mail failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Mail failed: ' . $e->getMessage()]);
        }
    }

    // ============ Verify OTP ================ //
    public function verifyOtp(Request $request) {
        $order = Order::findOrFail($request->order_id);

        if ((string)$order->otp !== (string)$request->otp) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
        }

        if (Carbon::now()->gt($order->otp_expires_at)) {
            return response()->json(['success' => false, 'message' => 'OTP expired. Resend.']);
        }

        $order->otp_verified = true;
        $order->order_status = 'confirmed';
        $order->save();

        try {
            $items     = OrderItem::with('product')->where('order_id', $order->id)->get();
            $userEmail = $order->customer->email; 
            Mail::to($userEmail)->send(new OrderConfirmMail($order, $items, $userEmail));
        } catch (\Exception $e) {
            \Log::error('OrderConfirmMail failed: ' . $e->getMessage());
        }

        session()->forget('order_id');

        return response()->json(['success' => true, 'message' => 'Order confirmed!']);
    }

    // ============ Order Success Page ================ //
    public function OrderSuccess() {
        $orderId = session('order_id');
        if (!$orderId) return redirect()->route('index');

        $order     = Order::with('customer')->findOrFail($orderId);
        $userEmail = $order->customer->email ?? 'N/A';
        return view('customer.order-success', compact('order', 'userEmail'));
    }
}