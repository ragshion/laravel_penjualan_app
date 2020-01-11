<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agen;
use App\SettingsMapApi;

class AgenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agen = Agen::orderBy('nama_toko','asc')->paginate(10);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $agen = Agen::orderBy('nama_toko','asc')->where('nama_toko','LIKE',"%$filterKeyword%")->paginate(10);
        }

        $data_agen = Agen::all();
        $x = 0;
        foreach ($data_agen as $row ) {
            // $hasil[] = array(
            //     '0' => $row->nama_toko,
            //     '1' => $row->latitude,
            //     '2' => $row->longitude,
            // );
            $hasil[$x]['0'] = $row->nama_toko;
            $hasil[$x]['1'] = $row->latitude;
            $hasil[$x]['2'] = $row->longitude;
            $x++;
        }

        $hasil_latlng = json_encode($hasil);
        $lokasi = Agen::first();

        $api = SettingsMapApi::first();

        return view('agen.index',compact('agen','hasil_latlng','lokasi','api'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
