<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {



        $data =[];
        $data['products'] =Product::with('section')->get();
        $data['sections'] =Section::all();
        return view('Products.product',$data);
    }


    public function store(ProductRequest $request)
    {
        Product::create([

            "Product_name"=>$request->Product_name,
            "section_id"=>$request->section_id,
            "description"=>$request->description,

        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect()->route('Products.index');

    }




    public function update(ProductRequest $request)
    {
        $product=Product::findOrFail($request->productId);
        $product->update([
            "Product_name"=>$request->Product_name,
            "section_id"=>$request->section_id,
            "description"=>$request->description,

        ]);

        session()->flash('edit','تم تعديل المنتج بنجاج');
        return redirect()->route('Products.index');
    }


    public function destroy(Request $request)
    {
        $product=Product::findOrFail($request->productId);
        $product->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect()->route('Products.index');
    }
}
