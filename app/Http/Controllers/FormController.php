<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $formItem = DB::table('forms')
        ->leftJoin('docs', function ($join) {
            $join->on('forms.form_id', '=', 'docs.foreign_key')
                 ->where('docs.type', '=', 'form');
        })
        ->where('forms.is_active', '!=', '0')
        ->select('forms.title as forms_title', 'forms.description as forms_description', 'docs.url as  docs_url')
        ->orderBy('forms.created_at', 'desc')
        ->get();

        $formItem->transform(function ($item) {
            if ($item->docs_url) {
                $item->docs_url = str_replace('public/', '', $item->docs_url);
            }
            return $item;
        });

    return view('form', compact('formItem'));
    }


    public function index()
    {
        $formItem = DB::table('forms')
        ->leftJoin('docs', function ($join) {
            $join->on('forms.form_id', '=', 'docs.foreign_key')
                 ->where('docs.type', '=', 'form');
        })
        ->where('forms.is_active', '!=', '0' )
        ->select('forms.title as forms_title', 'forms.description', 'docs.url')
        ->orderBy('forms.created_at', 'desc')
        ->get();

        $formItem->transform(function ($item) {
            if ($item->url) {
                $item->url = str_replace('public/', '', $item->url);
            }
            return $item;
        });

        return view('form.form', compact('formItem'));
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
        
        $messages = [
            'form_title.required' => 'The form title is required.',
            'form_description.required' => 'The form description is required.',
            'form_doc.required' => 'The doc is required',
            'form_doc.*.mimes' => 'The Document must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'form_title' => 'required',
            'form_description' => 'required',
            'form_doc' => 'required',
            'form_doc.*' => 'mimes:pdf',
        ], $messages);
    

        try {
        $formTitle = $request->input('form_title');
        $formdescription = $request->input('form_description');
        $formDoc = $request->file('form_doc');

        $formId = DB::table('forms')->insertGetId([
            'title' => $formTitle,
            'description' => $formdescription,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Store docs for workshop section
        if ($request ->hasFile('form_doc')) {
            $formDoc = $request->file('form_doc');
            
            foreach($formDoc as $formDoc){
                $docPath = $formDoc->store('public/docs');
                DB::table('docs')->insert([
                    'url' => $docPath,
                    'foreign_key' => $formId,
                    'type' => 'form',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'workshop stored successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while storing data.');
    }

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
}
