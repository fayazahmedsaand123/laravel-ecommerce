<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductAdd;
use App\Http\Requests\ProductUpdate;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Http\Requests\LoginAdd;
use App\Http\Requests\RegisterAdd;
use App\Http\Requests\UpdatePassword;

class EcommerceController extends Controller {

    protected $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }
    // ============== Product =============== //
    public function Product() {
        return view('product.product');
    }
    // =============== Product Store ================ //
    public function Product_Store(ProductAdd $request) {
        // Check if product name already exists for this user
        $exists = Product::where('user_id', session('login_id'))
            ->where('product_name', $request->product_name)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Name already exists'
            ]);
        }
        $this->productService->productStore($request);
        return response()->json([
            'status' => 'success',
            'message' => 'Added successfully',
            'redirect_to' => route('record_product')
        ]);
    }
    // =============== Product List ================= //
    public function Product_List() {
        $products = $this->productService->productlist();
        $user = User::find(session('login_id'));
        return view('product.record_product',compact('products','user'));
    }
    // ============== View Product ================= //
    public function View_Product($id) {
        $view_product = $this->productService->getViewProduct($id);
        return view('product.view_product',compact('view_product'));
    }
    // ================= Update Product ================= // 
    public function Update_Product($id) {
        $update_product = $this->productService->getUpdateProduct($id);
        return view('product.update_product',compact('update_product'));
    }
    public function Update_Product_Store(ProductUpdate $request,$id) {
        $this->productService->updateProductStore($request,$id);
        // $redirectURL = $request->input('redirect_to', route('record_product'));
        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'redirect_to' => route('record_product')
        ]);
    }
    // ==================== Delete Product ===================== //
    public function Delete_Product($id) {
        $result = $this->productService->getDeleteProduct($id);
        
        if($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ]);
        }

        return response()->json([
            'status' => 'fail',
            'message' => 'Product not found'
        ]);
    }
    // ================== My Earnings =================== //
    public function MyEarnings() {
        $sellerId = session('login_id'); 
        $earningsData = $this->productService->getMyEarnings($sellerId);

        return view('product.earning', [
            'earnings' => $earningsData['orders'],
            'totalEarnings' => $earningsData['totalEarnings']
        ]);
    }
    // ================= Seller Notifications ================= //
    public function SellerNotifications() {
        $sellerId = session('login_id');
        $notifications = $this->productService->getSellerNotifications($sellerId);

        return view('product.notifications', compact('notifications'));
    }
    // ======================= Register & Login ====================== //
    public function Register() {
        return view('auth.register');
    }
    // ================= Show Login form ====================== //
    public function Register_Form(RegisterAdd $request) {
        $this->productService->registerStore($request);
        return redirect()->route('login')->with('success','Your registered has successfully');
    }
    // ================== Show login form =================== //
    public function Login() {
        return view('auth.login');
    }
    public function Login_Form(LoginAdd $request) {
        $result = $this->productService->loginStore($request);

        if($result === 'email_not_found') {
            return back()->withInput()->with('fail', 'This email is not registered');
        }
        else if($result === 'account_disabled') {
            return back()->withInput()->with('fail', 'Your account is disabled. Contact admin.');
        }
        else if($result === 'password_wrong') {
            return back()->withInput()->with('fail', 'Password not matched');
        }
        else if(is_object($result) && $result->role === 'admin') {
            return redirect()->route('admin');
        }
        return redirect()->route('record_product');
    }
    // ================= Logout ==================== //
    public function Logout(Request $request) {
        session()->forget('login_id');
        session()->forget('role');
        return response()->json([
            'status' => 'success',
            'redirect_to' => route('login')
        ]);
    }
    // ================= Forget Password ================= //
    public function Forget_Password() {
        return view('auth.forget_password');
    }
    // ================== Send to Email ================== //
    public function SendResetLink(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $result = $this->productService->sendResetLink($request);
        if($result === 'success') {
            return redirect()->back()->with('success', 'Password reset link sent to your email'); 
        }
        else if($result === 'email_not_found') {
            return back()->withErrors([
                'email' => 'Email not found'
            ]);
        }
        else if($result === 'no_connection') {
            abort(404);
        }
    }
    // ============= Reset Password ============= //
    public function ResetPassword($token) {
        return view('auth.reset-password', compact('token'));
    }
    // =============== Update Password ===================== //
    public function UpdatePassword(UpdatePassword $request) {
        $result = $this->productService->updatePassword($request);
        if($result === 'invalid_token') {
            return back()->with('fail', 'Invalid or expired token');
        }
        return redirect()->route('login')->with('success', 'Password updated successfully');
    }
    // ================== Admin & Dashboard ==================== //
    public function Dashboard() {
        $admin = User::find(session('login_id'));

        return view('admin.dashboard',[
            'admin' => $admin,
            'totalUsers' => User::count(),
            'totalCustomer' => Customer::count(),
            'totalOrders' => Order::count(),
            // 'totalRevenue' => Order::sum('total_price')
        ]);
    }
    // ==================== Admin Order ============================= //
    public function AdminOrder() {
        $orders = Order::paginate('5');
        return view('admin.orders', compact('orders'));
    }
    // ==================== Customer List ========================== //
    public function Customer() {
        $customers = Customer::all();
        return view('admin.customer',compact('customers'));
    }
    // =================== Delete Customer ======================== //
    public function Delete_Customer($id) {
        $deleted = $this->productService->DeleteCustomer($id);
        if(!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found'
            ],404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Customer deleted successfully'
        ]);
    }
    // =================== Order Detail ================= //
    public function OrderDetail($id) {
        $data = $this->productService->getOrderDetail($id);
        return view('admin.order_detail', [
            'order' => $data['order'],'items' => $data['items'],
        ]);
    }
    // =================== Seller Order ===================== //
    public function SellerOrder() {
        $sellerId = session('login_id');
        if(!$sellerId) {
            return redirect()->route('login')->with('fail', 'Please login first');
        }

        $orders = $this->productService->getSellerOrders($sellerId);
        return view('admin.seller_order', compact('orders'));
    }

    // ================== View Seller ==================== //
    public function ViewSellers() {
        $sellers = $this->productService->getAllSellers();
        return view('admin.seller', compact('sellers'));
    }
    // ================== Make Admin ==================== //
    public function Make_Admin($id) {
        $result = $this->productService->makeAdmin($id);
        if($result) {
            return back()->with('success','Seller promoted to Admin successfully');
        }
        return back()->with('fail','User not found or already admin');
    }
    // =================== Disable Seller ================== //
    public function DisableSeller($id) {
        $result = $this->productService->disableSeller($id);
        if($result) {
            return back()->with('success','Seller account disabled successfully');
        }
        return back()->with('fail','User not found or cannot disable');
    }
    // =================== Enable Seller ==================== //
    public function EnableSeller($id) {
        $this->productService->enableSeller($id);
        return back();
    }
}
