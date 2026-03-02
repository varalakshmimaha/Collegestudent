<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = College::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%');
        }

        $colleges = $query->latest()->paginate(10);

        return view('colleges.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'nullable|string|max:50|unique:colleges',
                'address' => 'nullable|string',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'principal_name' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            $college = College::create($validated);

            if ($request->has('save_and_new')) {
                return redirect()->route('colleges.create')->with('success', 'College created successfully.');
            }

            return redirect()->route('colleges.index')->with('success', 'College created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('College create error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create college: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(College $college)
    {
        return view('colleges.show', compact('college'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(College $college)
    {
        return view('colleges.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, College $college)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'nullable|string|max:50|unique:colleges,code,' . $college->id,
                'address' => 'nullable|string',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'principal_name' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            $college->update($validated);

            return redirect()->route('colleges.index')->with('success', 'College updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('College update error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update college: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college)
    {
        try {
            $college->delete();
            return redirect()->route('colleges.index')->with('success', 'College deleted successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('College delete error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete college: ' . $e->getMessage());
        }
    }
}

