<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Borrowing;
use \App\BookList;
use Excel;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['peminjam'] = Borrowing::get();
        return view('peminjaman.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['buku'] = BookList::get();
        return view('peminjaman.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Borrowing;
        $table->nama_peminjam = $request->input('nama_peminjam');
        $table->alamat_peminjam = $request->input('alamat_peminjam');
        $table->judul_buku = $request->input('judul_buku');
        $table->tanggal_pinjam = $request->input('tanggal_pinjam');
        $table->tanggal_kembali = $request->input('tanggal_kembali');
        $table->denda = $request->input('denda');
        $table->status_peminjam = $request->input('status_peminjam');
        $table->save();

        $book = BookList::where('judul_buku', '=', $request->input('judul_buku'))->first();
        $total = $book->stok - 1;
        $book->stok = $total;
        $book->save();

        return redirect(url('/'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data['peminjam'] = Borrowing::find($id);
        // return view('peminjaman.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['peminjam'] = Borrowing::find($id);
        $data['buku'] = BookList::get();
        return view('peminjaman.edit')->with($data);
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
        $table = Borrowing::find($id);
        $table->nama_peminjam = $request->input('nama_peminjam');
        $table->alamat_peminjam = $request->input('alamat_peminjam');
        $table->judul_buku = $request->input('judul_buku');
        $table->tanggal_pinjam = $request->input('tanggal_pinjam');
        $table->tanggal_kembali = $request->input('tanggal_kembali');
        $table->denda = $request->input('denda');
        $table->status_peminjam = $request->input('status_peminjam');
        if ($request->input('status_peminjam')=="Belum Kembali") {
            
        }
        else {
            $stok = BookList::where('judul_buku', '=', $request->input('judul_buku'))->first();
            $total = $stok->stok + 1;
            $stok->stok = $total;        
            $stok->save();
        }
        $table->save();

        return redirect(url('pinjam'));
    }

    public function export()
    {
        if (!$result = Borrowing::get()->isEmpty()) {
            Excel::create("Daftar-Peminjam_" . date('dmyH'), function($result)
            {
                $result->sheet('SheetName', function($sheet)
                {
                    $pinjam = Borrowing::all();
                    foreach($pinjam as $item){
                        $data=[];
                        array_push($data, array(
                            $item->nama_peminjam,
                            $item->alamat_peminjam,
                            $item->judul_buku,
                            $item->tanggal_pinjam,
                            $item->tanggal_kembali,
                            $item->denda,
                            $item->status_peminjam
                        ));
                        $sheet->fromArray($data, null, 'A2', false, false);
                    }
                    $sheet->row(1, array('Nama Peminjam','Alamat Peminjam','Judul Buku','Tanggal Pinjam','Tanggal Kembali','Denda','Status Peminjaman'));
                    $sheet->setBorder('A1:B1', 'thin');
                    $sheet->setBorder('C1:D1', 'thin');
                    $sheet->setBorder('E1:F1', 'thin');
                    $sheet->setBorder('G1', 'thin');
                    $sheet->cells('A1:B1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->cells('C1:D1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->cells('E1:F1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->cells('G1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->setHeight(array(
                        '1' => '20'
                    ));
                    $sheet->setWidth('A', '25');
                    $sheet->setWidth('B', '25');
                    $sheet->setWidth('C', '25');
                    $sheet->setWidth('D', '25');
                    $sheet->setWidth('E', '25');
                    $sheet->setWidth('F', '25');
                    $sheet->setWidth('G', '25');
                });                    
                return redirect(url()->previous());
            })->download('xls');
        }
        return redirect(url()->previous());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
