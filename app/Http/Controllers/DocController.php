<?php

namespace App\Http\Controllers;
use App\models\Doc;
use Illuminate\Http\Request;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function deactivate($id)
    {
        $doc = Doc::findOrFail($id);

        if ($doc->is_active) {
            $doc->is_active = 0;
            $doc->save();
            return 'Document deleted successfully.';
        }

        return 'Document is already deactivated.';
    }
}
