<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StockOfBooks;
use App\BookList;
use Excel;

class StokBukuController extends Controller
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
        $data['stok'] = StockOfBooks::get();
        return view('admin.stok.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['buku'] = BookList::get();
        return view('admin.stok_buku.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new StockOfBooks;
        $table->judul_buku = $request->input('judul_buku');
        $table->nomor_rak = $request->input('nomor_rak');
        $table->jumlah_buku = $request->input('jumlah_buku');
        $table->save();
        
        $book = BookList::where('judul_buku', '=', $request->input('judul_buku'))->first();
        $jumlah = $request->input('jumlah_buku');
        $total = $book->stok + $jumlah;
        $book->stok = $total;
        $book->save();

        return redirect(url('/'));
    }

    public function export()
    {        
        if (!$result = StockOfBooks::get()->isEmpty()) {
            Excel::create("Stok-Buku_" . date('dmyH'), function($result)
            {
                $result->sheet('SheetName', function($sheet)
                {
                    $stok = StockOfBooks::all();
                    foreach($stok as $item){
                        $data=[];
                        array_push($data, array(                        
                            $item->judul_buku,
                            $item->nomor_rak,
                            $item->jumlah_buku
                        ));
                        $sheet->fromArray($data, null, 'A2', false, false);
                    }
                    $sheet->row(1, array('Judul Buku','Nomor Rak','Jumlah Buku'));
                    $sheet->setBorder('A1:B1', 'thin');
                    $sheet->setBorder('C1', 'thin');
                    $sheet->cells('A1:B1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->cells('C1', function($cells){
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
                });
                return redirect(url()->previous());
            })->download('xls');
        }
        return redirect(url()->previous());        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
    }
}
