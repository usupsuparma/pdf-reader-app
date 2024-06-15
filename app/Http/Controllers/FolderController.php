<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FolderController extends Controller
{
    public function openCarbonera()
    {
        $carboneraPath = public_path('carbonera');
        $indexFileContent = '<!DOCTYPE html><html><head><title>Carbonera</title></head><body><h1>Welcome to Carbonera</h1></body></html>';

        if (!File::exists($carboneraPath)) {
            // Buat folder carbonera jika belum ada
            File::makeDirectory($carboneraPath, 0755, true);

            // Buat file index.html di dalam folder carbonera
            File::put($carboneraPath . '/index.html', $indexFileContent);
        } elseif (!File::exists($carboneraPath . '/index.html')) {
            // Buat file index.html jika belum ada di dalam folder carbonera
            File::put($carboneraPath . '/index.html', $indexFileContent);
        }

        // Redirect ke direktori carbonera dengan trailing slash
        return redirect()->route('open.carbonera.index');
    }

    public function openCarboneraIndex()
    {
        // Tampilkan file index.html di dalam folder carbonera
        return response()->file(public_path('carbonera/index.html'));
    }
}
