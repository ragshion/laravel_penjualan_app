<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiDetail;
use PDF;

use App\Exports\TransaksiDetailExport;
use Excel;

class ReportPenjualanController extends Controller
{

    public function index(Request $request)
    {
        $penjualan = TransaksiDetail::orderBy('created_at','desc')->paginate(20);
        if ($request->get('start_date') != '' && $request->get('end_date') != '')
        {
            $start_date = date('Y-m-d', strtotime($request->get('start_date')));
            $end_date = date('Y-m-d', strtotime($request->get('end_date')));
            $penjualan = TransaksiDetail::whereBetween('created_at',[$start_date,$end_date])->orderBy('created_at','desc')->paginate(20);
            $start_date = \Carbon\Carbon::parse($start_date)->format('d F Y');
            $end_date = \Carbon\Carbon::parse($end_date)->format('d F Y');
        }
        return view('report_penjualan.index',compact('penjualan','start_date','end_date'));
    }

    public function cetak_pdf()
    {
        $penjualan = TransaksiDetail::orderBy('created_at','desc')->get();
        $pdf = PDF::loadview('report_penjualan.report_penjualan_pdf',compact('penjualan'));
        return $pdf->stream();
    }

    public function cetak_excel(){
        $tgl = now();
        return Excel::download(new TransaksiDetailExport, 'transaksi_detail_'.$tgl.'.xlsx');
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
