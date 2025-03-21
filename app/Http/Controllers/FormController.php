<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                //  ->where('docs.is_active', '=',  '1')
                //  ->where('docs.type', '=', 'form')
                //  ->take(1)
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = forms.form_id and type = "form" and is_active="1")');
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


    public function showDoc($doc_url)
    {
        // Assuming the documents are stored in the 'storage/docs' directory
        $docPath = storage_path( $doc_url);

        // Check if the document file exists
        if (!file_exists($docPath)) {
            abort(404);
        }

        // Return a view to display the document
        return response()->file($docPath);
    }



    public function index()
    {
        $formItem = DB::table('forms')
        ->leftJoin('docs', function ($join) {
            $join->on('forms.form_id', '=', 'docs.foreign_key')
            //      ->where('docs.is_active', '=',  '1')
            //      ->where('docs.type', '=', 'form')
            //      ->take(1)
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = forms.form_id and type = "form" and is_active="1")');

        })
        ->where('forms.is_active', '!=', '0' )
        ->select('forms.title as forms_title', 'forms.form_id as form_id', 'forms.description', 'docs.url')
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
        // $formDoc = $request->file('form_doc');

        $formId = DB::table('forms')->insertGetId([
            'title' => $formTitle,
            'description' => $formdescription,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Store docs for workshop section
        if ($request->hasFile('form_doc')) {
            $formDocs = $request->file('form_doc'); // Changed variable name to avoid conflict
            
            foreach ($formDocs as $formDoc) { // Changed loop variable name
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
        $form = DB::table('forms')
        ->where('form_id', $id)
        ->where('is_active', '!=', 0)
        ->first();


        if (!$form) {
            abort(404); // form not found
        }
        
        // Fetching all images related to the article
        $formImages = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'form')
                    ->where('images.is_active', '1')
                    ->get();

        $formDocs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'form')
                    ->where('docs.is_active', '1')
                    ->get();

    return view('form.editform', compact('form', 'formImages', 'formDocs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $form_id)
    {
        
        $messages = [
            'form_title.required' => 'The form title is required.',
            'form_description.required' => 'The form description is required.',
            // 'form_doc.required' => 'The doc is required',
            'form_doc.*.mimes' => 'The Document must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'form_title' => 'required',
            'form_description' => 'required',
            // 'form_doc' => 'required',
            'form_doc.*' => 'mimes:pdf',
        ], $messages);

        $form = Form::findOrFail($form_id);

        try {
            $form->	title = $request->input('form_title');
            $form->description = $request->input('form_description');
            // $form->location = $request->input('form_location');
            $form->updated_at =  now();
            $form->save();

    
            // Store docs for form section
            // if ($request ->hasFile('form_doc')) {
            //     $formDoc = $request->file('form_doc');
                
            //     foreach($formDoc as $formDoc){
            //         $docPath = $formDoc->store('public/docs');
            //         DB::table('docs')->insert([
            //             'url' => $docPath,
            //             'foreign_key' => $form_id,
            //             'type' => 'form',
            //             'created_at' => now(),
            //             'updated_at' => now(),
            //         ]);
            //     }
            // }

            $existingDoc = DB::table('docs')
            ->where('foreign_key', $form_id)
            ->where('type', 'form')
            ->where('is_active', 1)
            ->first();

        // Store docs for form section if no active document exists
        if ($request->hasFile('form_doc') && !$existingDoc) {
            $formDoc = $request->file('form_doc');
            foreach ($formDoc as $doc) {
                $docPath = $doc->store('public/docs');
                DB::table('docs')->insert([
                    'url' => $docPath,
                    'foreign_key' => $form_id,
                    'type' => 'form',
                    'is_active' => 1, // Set the new document as active
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($request->hasFile('form_doc') && $existingDoc) {
            return redirect()->back()->with('error', 'You can only have one active document for this form.');
        }

    
    
        return redirect()->back()->with('success', 'form updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating form');
    }
        
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
    try {
        $form = Form::findOrFail($id);
        $form->is_active = 0;
        $form->save();

        return redirect()->back()->with('success', 'form deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while deleting the form.');
    }

    
    }
}
