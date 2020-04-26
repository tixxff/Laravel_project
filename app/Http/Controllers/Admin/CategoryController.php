<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.CategoryForm')->with('categories',Category::paginate(5));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        //insert data to table
        $category=new Category;
        $category->name = $request->name;
        $category->save();
        Session()->flash("success","บันทึกข้อมูลเรียบร้อย");
        return redirect('/admin/createCategory');
    }

    public function edit($id){
        $category=Category::find($id);
        return view('admin.EditCategoryForm',['category'=>$category]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $category=Category::find($id);//3
        $category->name=$request->name;
        $category->save();
        Session()->flash("success","อัพเดทข้อมูลเรียบร้อย");
        return redirect('/admin/createCategory');
    }

    public function delete($id){

        $category=Category::find($id);
        if($category->products->count()>0){ //เช็คว่าหมวดหมู่ผูกกับตัวสินค้าไหม
            Session()->flash("warning","ไม่สามารถลบหมวดหมู่ได้ เพราะมีสินค้าที่ใช้หมวดหมู่นี้อยู่");
            return redirect()->back();
        }

        $category::destroy($id);
        Session()->flash("success","ลบข้อมูลเรียบร้อย");
        return redirect('/admin/createCategory');
    }
}
