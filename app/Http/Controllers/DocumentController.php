<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function showDocuments(Request $req)
    {
        $directory = public_path('documents');
        $files = scandir($directory);

        $fileNames = array_splice($files, 2);
    
        return view('pages.documents', ['documents' => $fileNames]);
    }

    public function downloadDocument(Request $req, $docName=null)
    {
        if($docName)
        {
            $docPath = public_path('documents/' . $docName); // Ensure the file name is appended to the path

            if (file_exists($docPath)) {
                // Return a download response
                return response()->download($docPath);
            } else {
                // Handle the case where the file doesn't exist
                abort(404);
            }
        }
    }
}
