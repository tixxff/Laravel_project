<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Product;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware("verifyCategory")->only(['create', 'store']);
    }

    public function index(){
        return view('admin.ProductDashboard')->with('products',Product::paginate(10));
    }

    public function create(){
        return view('admin.ProductForm')->with('categories',Category::all());
    }

    //edit product
    public function edit($id){
        $product=Product::find($id);
       // dd($product);
        return view('admin.editProductForm')
        ->with('categories',Category::all())
        ->with('product',Product::find($id));
    }

    public function update(Request $request, $id){
        //validate
        $request->validate([
            'name' => 'required',
            'description'=>'required',
            'price'=>'required|numeric',    
            'category'=>'required',
        ]);
        $product= Product::find($id); //search id product
        $product->name=$request->name; //match id with form request
        $product->description=$request->description;
        $product->price=$request->price;

        if($request->category){
            $product->category_id = $request->category;
        }
        $product->save();
        Session()->flash("success","อัพเดทข้อมูลเรียบร้อย");
        return redirect('/admin/dashboard');
    }

    public function updateImage(Request $request, $id){
        $request->validate([
            'image'=>'required|file|image|mimes:jpeg,png,jpg|max:5000'  
        ]);
        if($request->hasFile("image")){
            $product=Product::find($id);
            $exists=Storage::disk('local')->exists("public/product_image/".$product->image); //เจอไฟล์ภาพชื่อเหมือกัน

            if($exists){
                Storage::delete("public/product_image/".$product->image);
            }
            $request->image->storeAs("public/product_image/",$product->image);
            return redirect('/admin/dashboard');
        }
    }

    //edit image
    public function editImage($id){
        return view('admin.editProductImage')->with('product',Product::find($id));
    }

    public function store(Request $request){
        //validate
        $request->validate([
            'name' => 'required',
            'description'=>'required',
            'category'=>'required',
            'price'=>'required|numeric',
            'image'=>'required|file|image|mimes:jpeg,png,jpg|max:5000' //image download 5 mb
        ]);
        
        //convert image name
        $stringImageReformat=base64_encode('_'.time());
        $ext=$request->file('image')->getClientOriginalExtension();
        $imageName=$stringImageReformat.".".$ext;
        $imageEncoded=File::get($request->image);
        //dd($imageName);

        //upload & insert
        Storage::disk('local')->put('public/product_image/'.$imageName,$imageEncoded);

        //insert
        $product=new Product;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->category_id=$request->category;
        $product->price=$request->price;
        $product->image=$imageName;
        $product->save();
        //flat message
        Session()->flash("success","บันทึกข้อมูลเรียบร้อย");
        return redirect('/admin/dashboard');

    }

    public function delete($id){

        $product=Product::find($id);
        $exists=Storage::disk('local')->exists("public/product_image/".$product->image); //เจอไฟล์ภาพชื่อเหมือกัน
        if($exists){
            Storage::delete("public/product_image/".$product->image);
        }
        Product::destroy($id);
        Session()->flash("success","ลบข้อมูลเรียบร้อย");
        return redirect('/admin/dashboard');
    }
}
