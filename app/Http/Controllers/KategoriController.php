<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kategori;

class KategoriController extends Controller {

    public function __construct() {
		$this->authorizeResource(Kategori::class, 'kategori');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ) {

        $kategoris = Kategori::query();

        if(!empty($request->search)) {
			$kategoris->where('name', 'like', '%' . $request->search . '%');
		}

        $kategoris = $kategoris->paginate(10);

        return view('admin.kategoris.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.kategoris.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ) {

        $request->validate(["name" => "required", "masa_manfaat" => "required"]);

        try {

            $kategori = new Kategori();
            $kategori->name = $request->name;
            $kategori->masa_manfaat = $request->masa_manfaat;
            $kategori->save();

            return redirect()->route('kategoris.index', [])->with('success', __('Kategori created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('kategoris.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Kategori $kategori
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori,) {

        return view('admin.kategoris.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Kategori $kategori
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori,) {

        return view('admin.kategoris.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori,) {

        $request->validate(["name" => "required", "masa_manfaat" => "required"]);

        try {
            $kategori->name = $request->name;
            $kategori->masa_manfaat = $request->masa_manfaat;
            $kategori->save();

            return redirect()->route('kategoris.index', [])->with('success', __('Kategori edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('kategoris.edit', compact('kategori'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Kategori $kategori
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori,) {

        try {
            $kategori->delete();

            return redirect()->route('kategoris.index', [])->with('success', __('Kategori deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('kategoris.index', [])->with('error', 'Cannot delete Kategori: ' . $e->getMessage());
        }
    }

    
}
