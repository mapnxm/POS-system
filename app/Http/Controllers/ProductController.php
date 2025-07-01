<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index () {
        $categories = Categories::all();
        return view('addproducts', compact('categories'));
    }

        public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'img' => 'required|image|mimes:jpg,jpeg,png',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Pastikan kategori ada
        ]);

        
        // Menyimpan file gambar dan mendapatkan path
        $file = $request->file('img'); // Pastikan menggunakan 'img' sesuai validasi
        $fileName = $file->getClientOriginalName();
        $file->storeAs('public/img', $fileName); // Menyimpan di folder storage/app/public/img
        
        // dd($request->description);
        // Menyimpan produk ke database
        Products::create([
            'img' => $fileName,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id, // Menggunakan ID kategori yang dipilih
        ]);

        // Redirect setelah berhasil
        return redirect()->route('listmenu');
    }
    
    public function show()
    {
        $foods = Products::where('category_id', 1)->get();
        $drinks = Products::where('category_id', 2)->get(); 
        $desserts = Products::where('category_id', 3)->get();

        return view('listmenu', compact('foods', 'drinks', 'desserts'));
    }

   
    /**
     * Delete the specified product
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        
        // Delete the associated image file
        if ($product->img) {
            $imagePath = storage_path('app/public/img/' . $product->img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the product from database
        $product->delete();

        return redirect()->route('listmenu')->with('success', 'Menu berhasil dihapus');
    }
    /**
     * Show the form for editing the specified product
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Categories::all();
        return view('edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = Products::findOrFail($id);

        // Handle image upload if a new image is provided
        if ($request->hasFile('img')) {
            // Delete old image
            if ($product->img) {
                $oldImagePath = storage_path('app/public/img/' . $product->img);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store new image
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/img', $fileName);
            
            $product->img = $fileName;
        }

        // Update other fields
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        
        $product->save();

        return redirect()->route('listmenu')->with('success', 'Menu berhasil diperbarui');
    }

}
