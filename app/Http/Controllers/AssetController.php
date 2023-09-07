<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Asset;
use App\Models\Department;
use App\Models\Jnspengadaan;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Asset::class, 'asset');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $assets = Asset::query();

        if (!empty($request->search)) {
            $assets->where('name', 'like', '%' . $request->search . '%');
        }

        $assets->with('category')->get();
        $assets->with('jnsPengadaan')->get();
        $assets->with('department')->get();
        $assets->with('location')->get();
        $assets = $assets->paginate(10);

        if (Auth::user()->role == 'admin') {
            return view('admin.assets.index', compact('assets'));
        }else{
            return view('pimpinan.assets.index', compact('assets'));
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Kategori::all();
        $procurementTypes = Jnspengadaan::all();
        $locations = Lokasi::all();
        $users = User::all();
        $departments = Department::all();

        return view('admin.assets.create', compact('categories', 'procurementTypes', 'locations', 'users', 'departments'));
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
            "name" => "required",
            "deskripsi" => "required",
            "kategori_id" => "required",
            "jns_pengadaan_id" => "required",
            "tgl_perolehan" => "required",
            "nilai_perolehan" => "required",
            "lokasi_id" => "required",
            "asset_image_path" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
        ]);


        $asset = new Asset();
        $asset->name = $request->name;
        $asset->deskripsi = $request->deskripsi;
        $asset->kategori_id = $request->kategori_id;
        $asset->jns_pengadaan_id = $request->jns_pengadaan_id;
        $asset->tgl_perolehan = $request->tgl_perolehan;
        $asset->nilai_perolehan = $request->nilai_perolehan;
        $asset->lokasi_id = $request->lokasi_id;
        $asset->assigned_to_user_id = $request->assigned_to_user_id;
        $asset->department_id = $request->department_id;
        $asset->is_fixed_asset = !!$request->is_fixed_asset;
        // $asset->asset_image_path = $imagePath;

        if ($request->hasFile('asset_image_path')) {
            $imagePath = $request->file('asset_image_path')->store('assets', 'public');
            $asset->addMedia(storage_path('app/public/' . $imagePath))->toMediaCollection('images');
        }

        try {
            $asset->save();

            return redirect()->route('assets.index', [])->with('success', __('Asset created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('assets.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Asset $asset
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {

        if (Auth::user()->role == 'admin') {
            return view('admin.assets.show', compact('asset'));
        }else{
            return view('admin.assets.show', compact('asset'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Asset $asset
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset,)
    {

        $categories = Kategori::all();
        $procurementTypes = Jnspengadaan::all();
        $locations = Lokasi::all();
        $users = User::all();
        $departments = Department::all();

        return view('admin.assets.edit', compact('asset', 'categories', 'procurementTypes', 'locations', 'users', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset,)
    {

        $request->validate([
            "name" => "required", 
            "deskripsi" => "required", 
            "kategori_id" => "required", 
            "jns_pengadaan_id" => "required", 
            "tgl_perolehan" => "required", 
            "nilai_perolehan" => "required", 
            "lokasi_id" => "required", 
            "asset_image_path" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
        ]);

        try {
            $asset->name = $request->name;
            $asset->deskripsi = $request->deskripsi;
            $asset->kategori_id = $request->kategori_id;
            $asset->jns_pengadaan_id = $request->jns_pengadaan_id;
            $asset->tgl_perolehan = $request->tgl_perolehan;
            $asset->nilai_perolehan = $request->nilai_perolehan;
            $asset->lokasi_id = $request->lokasi_id;
            $asset->assigned_to_user_id = $request->assigned_to_user_id;
            $asset->department_id = $request->department_id;
            $asset->is_fixed_asset = !!$request->is_fixed_asset;

            if ($request->hasFile('asset_image_path')) {
                $imagePath = $request->file('asset_image_path')->store('assets', 'public');
                $asset->addMedia(storage_path('app/public/' . $imagePath))->toMediaCollection('images');
            }
            
            // $asset->asset_image_path = $request->asset_image_path;
            $asset->save();

            return redirect()->route('assets.index', [])->with('success', __('Asset edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('assets.edit', compact('asset'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Asset $asset
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset,)
    {

        try {
            $asset->delete();

            return redirect()->route('assets.index', [])->with('success', __('Asset deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('assets.index', [])->with('error', 'Cannot delete Asset: ' . $e->getMessage());
        }
    }
}
