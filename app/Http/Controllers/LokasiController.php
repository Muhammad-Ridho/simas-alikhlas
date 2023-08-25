<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lokasi;

class LokasiController extends Controller {

    public function __construct() {
		$this->authorizeResource(Lokasi::class, 'lokasi');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ) {

        $lokasis = Lokasi::query();

        if(!empty($request->search)) {
			$lokasis->where('name', 'like', '%' . $request->search . '%');
		}

        $lokasis = $lokasis->paginate(10);

        return view('admin.lokasis.index', compact('lokasis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.lokasis.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ) {

        $request->validate(["name" => "required"]);

        try {

            $lokasi = new Lokasi();
            $lokasi->name = $request->name;
            $lokasi->save();

            return redirect()->route('lokasis.index', [])->with('success', __('Lokasi created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('lokasis.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Lokasi $lokasi
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi,) {

        return view('admin.lokasis.show', compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Lokasi $lokasi
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi,) {

        return view('admin.lokasis.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi,) {

        $request->validate(["name" => "required"]);

        try {
            $lokasi->name = $request->name;
            $lokasi->save();

            return redirect()->route('lokasis.index', [])->with('success', __('Lokasi edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('lokasis.edit', compact('lokasi'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Lokasi $lokasi
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi,) {

        try {
            $lokasi->delete();

            return redirect()->route('lokasis.index', [])->with('success', __('Lokasi deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('lokasis.index', [])->with('error', 'Cannot delete Lokasi: ' . $e->getMessage());
        }
    }

    
}
