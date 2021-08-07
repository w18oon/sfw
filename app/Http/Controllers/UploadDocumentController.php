<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadDocumentController extends Controller
{

    public function __invoke(Request $request)
    {
        try {
            $path = explode('/', Storage::putFile('public/uploads', $request->file('document')));
            return response()->json(['name' => $path[2]]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
}
