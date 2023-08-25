<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentController extends Controller {

    public function __construct() {
		$this->authorizeResource(Department::class, 'department');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ) {

        $departments = Department::query();

        if(!empty($request->search)) {
			$departments->where('name', 'like', '%' . $request->search . '%');
		}

        $departments = $departments->paginate(10);

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.departments.create', []);
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

            $department = new Department();
            $department->name = $request->name;
            $department->save();

            return redirect()->route('departments.index', [])->with('success', __('Department created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('departments.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Department $department
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department,) {

        return view('admin.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Department $department
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department,) {

        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department,) {

        $request->validate(["name" => "required"]);

        try {
            $department->name = $request->name;
            $department->save();

            return redirect()->route('departments.index', [])->with('success', __('Department edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('departments.edit', compact('department'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Department $department
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department,) {

        try {
            $department->delete();

            return redirect()->route('departments.index', [])->with('success', __('Department deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('departments.index', [])->with('error', 'Cannot delete Department: ' . $e->getMessage());
        }
    }

    
}
