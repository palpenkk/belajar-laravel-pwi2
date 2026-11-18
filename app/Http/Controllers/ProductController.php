<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data_toko = [
            'nama_toko'   => 'Toko Nopal Sejahtera',
            'alamat_toko' => 'Jl. Terus Jadian Kagak',
            'status_toko' => 'Belum Pasti',
        ];

        // Eloquent ORM: 10 data per halaman, data terbaru di atas
        $data_product = Product::orderBy('id_product', 'desc')->paginate(10);

        return view('pages.product.show', [
            'data_toko'   => $data_toko,
            'data_produk' => $data_product,
        ]);
    }

    public function addProduct()
    {
        return view('pages.product.addProduct');
    }

    public function store(Request $request)
    {
        // validasi setiap data yang diinputkan
        $request->validate([
            'name_product'  => 'required|min:4|max:20',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|integer|min:0',
            'desc_product'  => 'required',
        ], [
            'name_product.min'       => 'Nama produk minimal 4 karakter.',
            'name_product.max'       => 'Nama produk maksimal 20 karakter.',
            'name_product.required'  => 'Nama produk wajib diisi.',
            'stock_product.required' => 'Stok produk wajib diisi.',
            'stock_product.integer'  => 'Stok produk harus berupa angka bulat.',
            'stock_product.min'      => 'Stok produk tidak boleh kurang dari 0.',
            'price_product.required' => 'Harga produk wajib diisi.',
            'price_product.integer'  => 'Harga produk harus berupa angka bulat.',
            'price_product.min'      => 'Harga produk tidak boleh kurang dari 0.',
            'desc_product.required'  => 'Deskripsi produk wajib diisi.',
        ]);

        // tambahkan data yang diinputkan ke dalam database
        Product::create([
            'name_product'  => $request->name_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'desc_product'  => $request->desc_product,
            'id_category'   => rand(1, 3), // kategori diacak karena tidak diinput user
        ]);

        // kembali ke halaman produk dengan pesan sukses
        return redirect('/product')->with('message', 'Data Berhasil Ditambahkan');
    }

    // menampilkan detail produk berdasarkan id
    public function show($id)
    {
        $produk_detail = Product::findOrFail($id);

        return view('pages.product.detail', [
            'detail_produk' => $produk_detail,
        ]);
    }

    // menampilkan form edit
    public function edit($id)
    {
        $data_product = Product::findOrFail($id);

        return view('pages.product.editProduct', [
            'updated_produk' => $data_product,
        ]);
    }

    // menyimpan perubahan data
    public function update($id, Request $request)
    {
        $request->validate([
            'name_product'  => 'required|min:4|max:20',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|integer|min:0',
            'desc_product'  => 'required',
        ], [
            'name_product.min'       => 'Nama produk minimal 4 karakter.',
            'name_product.max'       => 'Nama produk maksimal 20 karakter.',
            'name_product.required'  => 'Nama produk wajib diisi.',
            'stock_product.required' => 'Stok produk wajib diisi.',
            'stock_product.integer'  => 'Stok produk harus berupa angka bulat.',
            'stock_product.min'      => 'Stok produk tidak boleh kurang dari 0.',
            'price_product.required' => 'Harga produk wajib diisi.',
            'price_product.integer'  => 'Harga produk harus berupa angka bulat.',
            'price_product.min'      => 'Harga produk tidak boleh kurang dari 0.',
            'desc_product.required'  => 'Deskripsi produk wajib diisi.',
        ]);

        Product::findOrFail($id)->update([
            'name_product'  => $request->name_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'desc_product'  => $request->desc_product,
        ]);

        return redirect('/product')->with('message', 'Data Berhasil Diupdate');
    }

    // menghapus data
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect('/product')->with('message', 'Data Berhasil Dihapus');
    }
}