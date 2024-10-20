<?php

namespace App\Http\Controllers;

use App\Models\BrushingTeeth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrushingTeethController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('brushing-teeth/index', [
            'data' => $this->getList($request)
        ]);
    }

    public function getList(Request $request)
    {
        $query = BrushingTeeth::query();

        if ($request->user()->role == "user") {
            $query->where('user_id', $request->user()->id);
        }

        return $query->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'note' => 'required',
            'is_morning' => 'boolean',
            'is_afternoon' => 'boolean',
            'is_evening' => 'boolean',
        ]);

        $request->merge(['user_id' => $request->user()->id]);

        BrushingTeeth::create($request->all());

        return redirect()->route('brushing-teeth.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required',
            'note' => 'required',
            'is_morning' => 'boolean',
            'is_afternoon' => 'boolean',
            'is_evening' => 'boolean'
        ]);


        $data = BrushingTeeth::find($id);

        $data->update($request->all());

        return redirect()->route('brushing-teeth.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BrushingTeeth::find($id);
        $data->delete();

        return redirect()->route('brushing-teeth.index');
    }
}
