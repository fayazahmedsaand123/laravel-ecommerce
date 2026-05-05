<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductService {
    
    public function productStore(Request $request) {
        $product = new Product();
        $product->user_id = session('login_id');
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        if($request->hasfile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time().".".$image->getClientOriginalExtension();
            $image->move(public_path('product_image'),$imageName);
            $product->product_image = $imageName;
        }
        $product->save();
        return $product;
    }
    // ============ Product List =============== //
    public function productlist() {
        $userId = session('login_id');

        return Product::where('user_id', $userId)->latest()->paginate(4);
    }

    // ========== View Product ================= //
    public function getViewProduct($id) {
        return Product::where('id', $id)->where('user_id', session('login_id'))->firstOrFail();
    }

    // ============ Update Product ================ //
    public function getUpdateProduct($id) {
        return Product::where('id', $id)
            ->where('user_id', session('login_id'))
            ->firstOrFail();
    }

    public function updateProductStore(Request $request,$id) {
        $update_product = Product::where('id',$id)
                            ->where('user_id', session('login_id'))
                            ->firstOrFail();
        $update_product->product_name = $request->product_name;
        $update_product->product_price = $request->product_price;
        $update_product->product_description = $request->product_description;
        if($request->hasfile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time().".".$image->getClientOriginalExtension();
            $image->move(public_path('product_image'),$imageName);
            $update_product->product_image = $imageName;
        }
        $update_product->save();
        return $update_product;
    }
    // =============== Delete Product ==================== //
    public function getDeleteProduct($id) {
        return Product::where('id', $id)->where('user_id', session('login_id'))->delete();
    }
    // ============= Delete Customer =============== //
    public function DeleteCustomer($id) {
        $customer = Customer::find($id);
        if(!$customer) {
            return false;
        }
        $customer->delete();
        return true;
    }
    // ============== Earnings =================== //
    public function getMyEarnings($sellerId = null) {
        $sellerId = $sellerId ?? session('login_id');
        
        $orders = OrderItem::with(['product','order'])
            ->where('seller_id', $sellerId)
            ->latest()
            ->get();

        $totalEarnings = $orders->sum('subtotal');

        return [
            'orders' => $orders,
            'totalEarnings' => $totalEarnings
        ];
    }
    // ================= Seller Notifications ================= //
    public function getSellerNotifications($sellerId) {
        return OrderItem::with(['product','order'])
            ->where('seller_id', $sellerId)
            ->latest()
            ->get();
    }
    // =========== Register user =========== //
    public function registerStore(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        // Handle Profile Image Upload
        if($request->hasfile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time()."_user.".$image->getClientOriginalExtension();
            $image->move(public_path('profile_images'), $imageName);
            $user->profile_image = $imageName;
        }
        $user->save();
        return $user;
    }
    // =========================== Login Service ============================== //
    public function loginStore(Request $request) {
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return 'email_not_found';
        }
        else if($user->status === 'disabled') {
            return 'account_disabled';
        }
        else if(!Hash::check($request->password, $user->password)) {
            return 'password_wrong';
        }
        session()->put('login_id', $user->id);
        session()->put('role', $user->role);
        return $user;
    }
    // ========== Forgot Password : Send Reset Link ========== //   
    public function sendResetLink(Request $request) {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return 'email_not_found';
        }
        try {
            $token = Str::random(65);
            PasswordReset::updateOrCreate(
                ['email' => $request->email],
                ['token' => $token,'created_at' => now()]
            );
            Mail::send('auth.reset-mail', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Your Password');
            });
            return 'success';
        }
        catch(\Exception $e) {
            return "no_connection";
        }
    }
    // ========== Reset Password Service ========== //  
    public function updatePassword(Request $request) {
        $reset = PasswordReset::where('token', $request->token)->first();
        if (!$reset) {
            return 'invalid_token';
        }
        User::where('email', $reset->email)->update([
            'password' => Hash::make($request->password)
        ]);
        PasswordReset::where('email', $reset->email)->delete();
        return true;
    }
    // ================= Order Detail ================= //
    public function getOrderDetail($id) {
        $order = Order::findOrFail($id);
        $items = OrderItem::where('order_id', $id)->get();

        return [
            'order' => $order,
            'items' => $items
        ];
    }
    // ================= Seller Orders ================= //
    public function getSellerOrders($sellerId) {
        return OrderItem::with(['product', 'order', 'seller'])
            ->where('seller_id', $sellerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    // ========== Get all sellers ============ //
    public function getAllSellers() {
        return User::whereIn('role', ['seller','admin'])->get();
    }
    // ========== Promote seller to admin  ========== //
    public function makeAdmin($id) {
        $user = User::find($id);

        if (!$user) return false;

        $user->role = 'admin';
        $user->save();

        return true;
    }
    // ============= Disable seller account ============ //
    public function disableSeller($id) {
        $user = User::find($id);

        if (!$user) { 
            return false;
        }
        // If user is admin → convert to seller
        else if ($user->role === 'admin') {
            $user->role = 'seller';
        }

        $user->status = 'disabled';
        $user->save();

        return true;
    }
    // =========== Enable seller account ================ //
    public function enableSeller($id) {
        $user = User::find($id);

        if (!$user) { 
            return false;
        }
        $user->status = 'active';
        $user->save();
        return true;
    }
}
?>