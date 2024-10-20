<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('education/index', [
            'data' => $this->getList($request)
        ]);
    }

    public function getList(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $page  = $request->page ? $request->page : 1;

        $data = Education::query();

        if ($request->search) {
            $data->whereLike($request->search, ['name', 'email']);
        }

        return $data->paginate($limit, ['*'], 'page', $page);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('education/form', [
            'editable' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'title' => 'required'
        ]);

        Education::create([
            'body' => $request->body,
            'title' => $request->title,
            'published_at' => now()
        ]);

        return redirect()->route('education.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        return Inertia::render('education/form', [
            'education' => $education,
            'editable' => false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Education $education)
    {
        return Inertia::render('education/form', [
            'education' => $education,
            'editable' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        $request->validate([
            'body' => 'required',
            'title' => 'required'
        ]);

        $education->update($request->all());

        return redirect()->route('education.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('education.index');
    }
}
