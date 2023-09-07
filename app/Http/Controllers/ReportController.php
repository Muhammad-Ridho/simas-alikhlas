<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Report::class, 'report');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,)
    {

        $reports = Report::query();

        $reports->with('asset');

        if (!empty($request->search)) {
            $reports->where('keterangan', 'like', '%' . $request->search . '%');
        }

        $reports = $reports->paginate(10);

        if (Auth::user()->role == 'admin') {
            return view('admin.reports.index', compact('reports'));
        } else {
            return view('pimpinan.reports.index', compact('reports'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $assets = \App\Models\Asset::all();

        return view('admin.reports.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,)
    {

        $request->validate([
            "asset_id" => "required", 
            "tanggal_laporan" => "required", 
            "nilai_perolehan" => "required", 
            // "umur_aset" => "required", 
            "penyusutan_per_bulan" => "required", 
            "penyusutan_per_tahun" => "required", 
            "nilai_saat_ini" => "required", 
            "keterangan" => "required"]);

        try {

            $report = new Report();
            $report->asset_id = $request->asset_id;
            $report->tanggal_laporan = $request->tanggal_laporan;
            $report->nilai_perolehan = $request->nilai_perolehan;
            $report->umur_aset = $request->umur_aset;
            $report->penyusutan_per_bulan = $request->penyusutan_per_bulan;
            $report->penyusutan_per_tahun = $request->penyusutan_per_tahun;
            $report->nilai_saat_ini = $request->nilai_saat_ini;
            $report->keterangan = $request->keterangan;
            $report->save();

            return redirect()->route('reports.index', [])->with('success', __('Report created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('reports.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Report $report
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report,)
    {

        return view('admin.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Report $report
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report,)
    {

        $assets = \App\Models\Asset::all();

        return view('admin.reports.edit', compact('report', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report,)
    {

        $request->validate([
            "asset_id" => "required", 
            "tanggal_laporan" => "required", 
            "nilai_perolehan" => "required", 
            // "umur_aset" => "required", 
            "penyusutan_per_bulan" => "required", 
            "penyusutan_per_tahun" => "required", 
            "nilai_saat_ini" => "required", 
            "keterangan" => "required"]);

        try {
            $report->asset_id = $request->asset_id;
            $report->tanggal_laporan = $request->tanggal_laporan;
            $report->nilai_perolehan = $request->nilai_perolehan;
            $report->umur_aset = $request->umur_aset;
            $report->penyusutan_per_bulan = $request->penyusutan_per_bulan;
            $report->penyusutan_per_tahun = $request->penyusutan_per_tahun;
            $report->nilai_saat_ini = $request->nilai_saat_ini;
            $report->keterangan = $request->keterangan;
            $report->save();

            return redirect()->route('reports.index', [])->with('success', __('Report edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('reports.edit', compact('report'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Report $report
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report,)
    {

        try {
            $report->delete();

            return redirect()->route('reports.index', [])->with('success', __('Report deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('reports.index', [])->with('error', 'Cannot delete Report: ' . $e->getMessage());
        }
    }
}
