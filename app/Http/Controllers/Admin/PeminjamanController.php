<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pinjam;
use App\Stock;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataStock = Stock::doesntHave('pinjam')->get();
        $dataPeminjaman = Pinjam::all();
        return view('admin.peminjaman.index',compact('dataPeminjaman','dataStock'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataStock = Stock::all();
        return view('admin.peminjaman.create',compact('dataStock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'nama_peminjam'             => 'required',
            ],
            [
                'nama_peminjam.required'    => "Nama peminjam harus diisi",
            ]
        );

        $dataPeminjaman = new Pinjam;
        $dataPeminjaman->nama_peminjam = $request->input('nama_peminjam');
        $dataPeminjaman->stock_id =  $request->stock_id;
        $dataPeminjaman->tanggal_dipinjam = Carbon::now();
        $dataPeminjaman->save();
        return redirect('admin/peminjaman/');
        
    }               

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataPeminjaman = Pinjam::find($id);
        $dataPeminjaman->delete();

        return redirect('admin/peminjaman/')->with('success', 'Data barang berhasil di hapus');
    }
}
