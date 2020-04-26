<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Category; //import category
use App\Product;
use App\Cart;

class ProductController extends Controller
{
    public function index(){
        return view("products.showProduct")
        ->with("products",Product::paginate(6)) 
        ->with("categories",Category::all()->sortBy('name')); //model categories //น้อยไปมาก
    }

    public function findCategory($id){
        $category=Category::find($id);

        return view("products.showCategory")
        ->with("categories", Category::all()->sortBy('name'))
        ->with("products",$category->products()->paginate(3)) //products is function
        ->with('feature',$category->name);
        //dd($category->products);
    }

    public function details ($id){
        $product=Product::find($id);
        return view("products.showProductdetails")
        ->with("product", $product)
        ->with("categories", Category::all()->sortBy('name'));
    }

    public function addProductToCart(Request $request, $id){
        //$request->session()->forget('cart');
        $product=Product::find($id);
        $prevCart=$request->session()->get('cart');
        $cart = new Cart($prevCart); //ส่งclass prevCart เหมือนสร้างตะกร้าใหม่ขึ้นมา
        $cart->addItem($id, $product); //โยนข้อมูลสินค้าไปเก็บ
        //update cart
        $request->session()->put('cart', $cart);
      //  dump($cart);
        return redirect ('/products');
       
    }

    public function showCart(){
        $cart=Session::get('cart'); //ดึงข้อมูลตะกร้าสินค้า
        if($cart){
            return view('products.showCart', ['cartItems'=>$cart]);
        }else{
            return redirect('/products');
        }

    }
}
