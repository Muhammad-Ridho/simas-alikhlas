<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ReportAsset;

class ReportAssetController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(ReportAsset::class, 'reportAsset');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,)
    {

        $reportAssets = ReportAsset::query();

        $reportAssets->with('asset');

        if (!empty($request->search)) {
            $reportAssets->where('name', 'like', '%' . $request->search . '%');
        }

        $reportAssets = $reportAssets->paginate(10);

        return view('admin.report_assets.index', compact('reportAssets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $assets = \App\Models\Asset::all();

        return view('admin.report_assets.create', compact('assets'));
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

        $request->validate(["name" => "required", "asset_id" => "required", "tanggal_laporan" => "required", "nilai_perolehan" => "required", "umur_aset" => "required", "penyusutan_per_tahun" => "required", "nilai_saat_ini" => "required"]);

        try {

            $reportAsset = new ReportAsset();
            $reportAsset->name = $request->name;
            $reportAsset->asset_id = $request->asset_id;
            $reportAsset->tanggal_laporan = $request->tanggal_laporan;
            $reportAsset->nilai_perolehan = $request->nilai_perolehan;
            $reportAsset->umur_aset = $request->umur_aset;
            $reportAsset->penyusutan_per_tahun = $request->penyusutan_per_tahun;
            $reportAsset->nilai_saat_ini = $request->nilai_saat_ini;
            $reportAsset->save();

            return redirect()->route('report_assets.index', [])->with('success', __('Report Asset created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('report_assets.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ReportAsset $reportAsset
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ReportAsset $reportAsset,)
    {

        return view('admin.report_assets.show', compact('reportAsset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ReportAsset $reportAsset
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportAsset $reportAsset,)
    {

        $assets = \App\Models\Asset::all();

        return view('admin.report_assets.edit', compact('reportAsset', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportAsset $reportAsset,)
    {

        $request->validate(["name" => "required", "asset_id" => "required", "tanggal_laporan" => "required", "nilai_perolehan" => "required", "umur_aset" => "required", "penyusutan_per_tahun" => "required", "nilai_saat_ini" => "required"]);

        try {
            $reportAsset->name = $request->name;
            $reportAsset->asset_id = $request->asset_id;
            $reportAsset->tanggal_laporan = $request->tanggal_laporan;
            $reportAsset->nilai_perolehan = $request->nilai_perolehan;
            $reportAsset->umur_aset = $request->umur_aset;
            $reportAsset->penyusutan_per_tahun = $request->penyusutan_per_tahun;
            $reportAsset->nilai_saat_ini = $request->nilai_saat_ini;
            $reportAsset->save();

            return redirect()->route('report_assets.index', [])->with('success', __('Report Asset edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('report_assets.edit', compact('reportAsset'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ReportAsset $reportAsset
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportAsset $reportAsset,)
    {

        try {
            $reportAsset->delete();

            return redirect()->route('report_assets.index', [])->with('success', __('Report Asset deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('report_assets.index', [])->with('error', 'Cannot delete Report Asset: ' . $e->getMessage());
        }
    }
}
