<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BookList;
use Excel;

class DaftarBukuController extends Controller
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
        $data['buku'] = BookList::get();
        return view('home')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.daftar_buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new BookList;
        $table->id = $request->input('kode_buku');
        $table->kode_buku = $request->input('kode_buku');
        $table->judul_buku = $request->input('judul_buku');
        $table->pengarang = $request->input('pengarang');
        $table->kategori = $request->input('kategori');       
        $table->save();

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
        $data['buku'] = BookList::find($id);
        return view('admin.daftar_buku.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['buku'] = BookList::find($id);
        return view('admin.daftar_buku.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $table = BookList::find($request->input('id'));
        $table->id = $request->input('kode_buku');
        $table->kode_buku = $request->input('kode_buku');
        $table->judul_buku = $request->input('judul_buku');
        $table->pengarang = $request->input('pengarang');
        $table->kategori = $request->input('kategori');        
        $table->save();

        return redirect(url('buku'.'/'.$request->input('kode_buku')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = BookList::find($id);
        $book->delete();

        return redirect(url('/'));
    }

    public function export()
    {
        if (!$result = BookList::get()->isEmpty()) {
            Excel::create("Daftar-Buku_" . date('dmyH'), function($result)
            {
                $result->sheet('SheetName', function($sheet)
                {
                    $buku = BookList::all();
                    foreach($buku as $item){
                        $data=[];
                        array_push($data, array(
                            $item->kode_buku,
                            $item->judul_buku,
                            $item->pengarang,
                            $item->kategori
                        ));
                        $sheet->fromArray($data, null, 'A2', false, false);
                    }
                    $sheet->row(1, array('Kode Buku','Judul Buku','Pengarang','Kategori'));
                    $sheet->setBorder('A1:B1', 'thin');
                    $sheet->setBorder('C1:D1', 'thin');
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
                    $sheet->setHeight(array(
                        '1' => '20'
                    ));
                    $sheet->setWidth('A', '10');
                    $sheet->setWidth('B', '25');
                    $sheet->setWidth('C', '25');
                    $sheet->setWidth('D', '25');
                });                    
                return redirect(url()->previous());
            })->download('xls');
        }
        return redirect(url()->previous());
    }
}
