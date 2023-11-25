<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */




    public function index()
    {
        //
        return view('pages.inbound');
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
    public function inbound()
    {
        // $document = DB::table('documents')->leftJoin('records', 'documents.id', 'records.document_id')
        // ->selectRaw('records.*')->with('files')
        // ->where('documents.valid', 0)->where('records.assigned_id', '=',auth()->user()->id)
        // ->distinct()->get();
        // $document = Document::leftJoin('records', 'documents.id', '=', 'records.document_id')
        //     ->select('records.*','documents.name')
        //     ->with('file') // Chargez la relation 'files' ici
        //     ->where('documents.valid', 0)
        //     ->where('assigned_id', '=', auth()->user()->id)
        //     ->distinct()
        //     ->get();
        // $document = Document::all();

        // $document = Document::where('user_id', auth()->user()->id)->get();

        // $document = Document::where('valid', 0)
        // ->whereHas('records', function ($query) {
        //     $query->where('assigned_id', auth()->user()->id);
        // })
        // ->get();

        $user = Auth::user();

        // Récupérer les documents créés par l'utilisateur authentifié
        $documentsCrees = $user->documents;

        // Récupérer les documents attribués à l'utilisateur authentifié
        $documentsRecus = $user->assignedDocuments;

        // Combiner les deux collections de documents
        $document = $documentsCrees->concat($documentsRecus);

        \App\Models\User::logUserActivity('A consulter un document');
        return view('pages.inbound', compact('document'));
    }
    public function outbound()
    {
        // $document = Document::leftJoin('records', 'documents.id', '=', 'records.document_id')
        //     ->select('records.*', 'documents.name')
        //     ->with('file') // Chargez la relation 'files' ici
        //     ->where('documents.valid', 1)
        //     ->where('assigned_id', '=', auth()->user()->id)
        //     ->distinct()
        //     ->get();
        $document = Document::where('valid', 1)
            ->whereHas('records', function ($query) {
                $query->where('created_id', auth()->user()->id);
            })
            ->get();
        \App\Models\User::logUserActivity('A consulter  un document');
        return view('pages.outbound', compact('document'));
    }
    public function store(StoreDocumentRequest $request)
    {
        //
        $Document = Document::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        $files = $request->file('path');
        foreach ($files as $path) {
            $f = new File();
            $f->name = $path->getClientOriginalName();
            $f->document_id = $Document->id;
            $f->path = 'storage/' . $path->store('document', 'public');
            \App\Models\User::logUserActivity('enregistre le fichier ' . $path->getClientOriginalName() . 'pour le document ' . $Document->name);
            $f->save();
        }
        return redirect()->back()->with('message', 'document created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    // public function sendDoc(Request $request, $id)
    // {
    //     $request->validate([
    //         'receiver' => 'required',
    //     ]);
    //     $doc = $id;

    //     // Vérifiez les autorisations ici si nécessaire.

    //     $userIds = $request->input('receiver');

    //     // Récupérez les utilisateurs en une seule requête.
    //     $users = User::whereIn('id', $userIds)->get();
    //     $docs = Document::find($id);
    //     if ($docs) {
    //         $docs->update(['valid' => 1]);
    //     }
    //     foreach ($users as $user) {
    //         $record = new \App\Models\Record();
    //         $record->document_id = $doc;
    //         $record->created_id = auth()->user()->id;
    //         $record->assigned_id = $user->id;

    //         // Utilisez le firstOrCreate pour éviter la création d'enregistrements dupliqués.
    //         \App\Models\Record::firstOrCreate([
    //             'document_id' => $doc,
    //             'created_id' => auth()->user()->id,
    //             'assigned_id' => $user->id,
    //         ]);
    //     }
    //     \App\Models\User::logUserActivity('Envoi un document  ');
    //     return redirect()->back()->with('message', 'document sent successfully');
    // }

    public function sendDoc(Request $request, $id)
    {
        $request->validate([
            'receiver' => 'required',
        ]);

        // Récupérez le document
        $doc = Document::find($id);

        if (!$doc) {
            return redirect()->back()->with('message', 'Document not found');
        }

        // Vérifiez les autorisations ici si nécessaire.

        $userIds = $request->input('receiver');

        // Récupérez les utilisateurs en une seule requête.
        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            $record = new \App\Models\Record();
            $record->document_id = $doc->id;
            $record->created_id = auth()->user()->id;
            $record->assigned_id = $user->id;

            // Utilisez le firstOrCreate pour éviter la création d'enregistrements dupliqués.
            \App\Models\Record::firstOrCreate([
                'document_id' => $doc->id,
                'created_id' => auth()->user()->id,
                'assigned_id' => $user->id,
            ]);
        }

        // Mettez à jour l'attribut 'valid' du document en 1
        $doc->valid = 1;
        $doc->save();

        \App\Models\User::logUserActivity('Envoi un document  ');

        return redirect()->back()->with('message', 'Document sent successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
        $document->delete();
        \App\Models\User::logUserActivity('Supprime un fichier ');
        return redirect()->back()->with('message', 'Document deleted successfully');
    }
}
