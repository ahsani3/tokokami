<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function produk()
    {
        $title = 'Produk';

        // mengambil data dari tabel produks
        $produk = DB::table('kategoris')->join('produks', 'kategoris.id', '=', 'produks.kategori_id')->get();
        $kategori = DB::table('kategoris')->get();

        // mengirim data ke view admin->produk
        return view('admin.produk', ['dataProduk' => $produk, 'dataKategori' => $kategori, 'title' => $title]);
    }

    public function store(Request $request)
    {
        // insert data ke tabel produks
        DB::table('produks')->insert([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $request->gambar,
            'kategori_id' => $request->kategori_id,
        ]);

        // alihkan halaman ke halaman produk
        return redirect('/admin/produk');
    }

    public function update(Request $request)
    {
        // update data tabel produks
        DB::table('produks')->where('id', $request->id)->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $request->gambar,
            'kategori_id' => $request->kategori_id,
        ]);

        // alihkan halaman ke halaman produk
        return redirect('/admin/produk');
    }

    public function delete(Request $request)
    {
        // hapus data tabel produks
        DB::table('produks')->where('id', $request->id)->delete();

        // alihkan halaman ke halaman produk
        return redirect('/admin/produk');
    }
}