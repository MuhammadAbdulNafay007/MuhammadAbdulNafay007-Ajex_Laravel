<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('user.product.index', compact('products'));
    }

    public function fetchProduct()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('user.product.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'description' => 'required|max:191',
            'price' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $data = new Product();
            $data->name = $request->name;
            $data->description = $request->description;
            $data->price = $request->price;
            $data->save();
            return response()->json([
                'status' => 200,
                'message' => 'Product Added Successfully. Click on View Button to see Products'
            ]);
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if($product)
        {
            return view('user.product.edit', compact('product'));
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'description' => 'required|max:191',
            'price' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $data = Product::find($id);
            if ($data) {

                $data->name = $request->name;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Product Updated Successfully. Click on View Button to See Updated Product.'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Product Not Found.'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
            $product->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Product Deleted Successfully.'
            ]);
    }

}
