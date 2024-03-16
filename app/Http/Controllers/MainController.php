<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index() {
        $allProducts = Products::all();
        $newArrival = Products::where('type', 'new-arrivals')->get();
        $hotSale = Products::where('type', 'sale')->get();

        return view('index', compact('allProducts', 'newArrival', 'hotSale'));
    }

    public function cart() {
        $cartItems = DB::table('products')
        ->join('carts','carts.productId','products.id')
        ->select('products.title','products.price','products.picture','products.quantity as pQuantity','carts.*')
        ->where('carts.customerId',session()->get('id'))
        ->get();
        return view('shopping-cart',compact('cartItems'));
    }

    public function checkout() {
        return view('checkout');
    }

    public function shop() {
        return view('shop');
    }

    public function shopdetail($id) {
        $product = Products::find($id);
        return view('shop-details', compact('product'));
    }

    public function register() {
        return view('register');
    }

    public function registerUser(Request $data) {
        $data->validate([
            'name'=>'required',
            'email'=>'required',
            'pass'=>'required',
            'pic'=>'nullable'
        ]);

        $imgname = time().'.'.$data->pic->extension();
        $data->pic->move(public_path('upload'), $imgname);

        $user = new Users;
        $user->image = $imgname;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->pass;
        $user->type = "Customer";
        
        $user->save();
        
        return redirect('login')->withSuccess('Register successfully! Please Login');
    }

    public function login() {
        return view('login');
    }

    public function loginUser(Request $data) {
        $user = User::where('email',$data->input('mail'))->where(('password'),$data->input('password'))->first();
        if ($user) {
            session()->put('id',$user->id);
            session()->put('type',$user->type);

            if($user->type=='Customer') {
                return redirect('/');
            }
            // else {
            //     return redirect('/admin');
            // }
        }
        else {
            return redirect('login')->with('error','Email/Password is incorrect');
        }
    }

    public function logout() {
        session()->forget('id');
        session()->forget('type');
        return redirect('login');
    }

    public function addToCart(Request $data) {

        // return view('blog');

        if (session()->has('id')) {
        $item = new Cart;
        $item->quantity = $data->quantity;
        $item->productId = $data->id;
        $item->customerId = session()->get('id');
        $item->save();
        return back()->withSuccess('Congratulation! item added into cart!');
        }
        else {
            return redirect('login')->withError('Warning! Please login to account first'); 
        }
        
    }

    public function updateCart(Request $data, $id) {
        if(session()->has('id')) {

            $item = Cart::where('id',$id)->first();
            $item->quantity =  $data->quantity;
            $item->save();
            return back()->withSuccess('Item Quantity Updated!');
        }
        else {
            return redirect('login')->withError('Warning! Please login to account first'); 
        }
    }

    public function deleteCartItem($id) {
        $item = Cart::where('id',$id)->first();
        $item->delete();
        return back()->with('success','Item is succesfully deleted');
    }
}
