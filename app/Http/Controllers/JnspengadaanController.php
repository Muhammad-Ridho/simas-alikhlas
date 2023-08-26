<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jnspengadaan;

class JnspengadaanController extends Controller {

    public function __construct() {
		$this->authorizeResource(Jnspengadaan::class, 'jnspengadaan');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ) {

        $jnspengadaans = Jnspengadaan::query();

        if(!empty($request->search)) {
			$jnspengadaans->where('name', 'like', '%' . $request->search . '%');
		}

        $jnspengadaans = $jnspengadaans->paginate(10);

        return view('admin.jnspengadaans.index', compact('jnspengadaans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.jnspengadaans.create', []);
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

            $jnspengadaan = new Jnspengadaan();
            $jnspengadaan->name = $request->name;
            $jnspengadaan->save();

            return redirect()->route('jnspengadaans.index', [])->with('success', __('Jnspengadaan created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('jnspengadaans.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Jnspengadaan $jnspengadaan
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Jnspengadaan $jnspengadaan,) {

        return view('admin.jnspengadaans.show', compact('jnspengadaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Jnspengadaan $jnspengadaan
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Jnspengadaan $jnspengadaan,) {

        return view('admin.jnspengadaans.edit', compact('jnspengadaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jnspengadaan $jnspengadaan,) {

        $request->validate(["name" => "required"]);

        try {
            $jnspengadaan->name = $request->name;
            $jnspengadaan->save();

            return redirect()->route('jnspengadaans.index', [])->with('success', __('Jnspengadaan edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('jnspengadaans.edit', compact('jnspengadaan'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Jnspengadaan $jnspengadaan
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jnspengadaan $jnspengadaan,) {

        try {
            $jnspengadaan->delete();

            return redirect()->route('jnspengadaans.index', [])->with('success', __('Jnspengadaan deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('jnspengadaans.index', [])->with('error', 'Cannot delete Jnspengadaan: ' . $e->getMessage());
        }
    }

    
}
