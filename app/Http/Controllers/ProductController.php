<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Menampilkan daftar produk (untuk tampilan /view)
    public function view()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('product.create');
    }

    // Menyimpan data produk baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'brand' => 'required|string',
            'chategory' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Product::create($request->all());

        return redirect()->route('product.view')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan data produk berdasarkan ID
    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    // Update data produk
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'product_name' => 'sometimes|required|string',
            'brand' => 'sometimes|required|string',
            'chategory' => 'sometimes|required|string',
            'price' => 'sometimes|required|integer|min:0',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($request->all());

        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }

    // Hapus data produk
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
