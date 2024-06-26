<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEbookRequest;
use App\Models\EbookModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use ZipArchive;

class EbookController extends Controller
{
    public function create(Request $request)
    {
        //
    }

    public function add(Request $request)
    {
        return view('ebook.add-ebook');
    }

    public function store(StoreEbookRequest $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $request->validated();
                $fileName = '';
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $path = 'pdf/' . $originalName;
                    $filePath = public_path('pdf/' . $file->getClientOriginalName());
                    $fileName = $path;
                    $file->move(public_path('pdf'), $file->getClientOriginalName());
                    $this->unzipFile($filePath, public_path('pdf'));

                    if (file_exists($filePath)) {
                        if (unlink($filePath)) {
                            Log::info('File ZIP berhasil dihapus: ' . $filePath);
                        } else {
                            Log::error('Gagal menghapus file ZIP: ' . $filePath);
                        }
                    }
                }
                $request->merge(['path' => $fileName]);
                EbookModel::create($request->all());
                DB::commit();
                return response()->json(['status' => 'success']);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
            }
        }
    }


    private function unzipFile($filePath, $extractPath)
    {
        $zip = new ZipArchive;

        if ($zip->open($filePath) === TRUE) {
            $zip->extractTo($extractPath);

            $zip->close();
        } else {
            throw new \Exception('Failed to open the zip file.');
        }
    }

    private function moveFiles($source, $destination)
    {
        $files = scandir($source);
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;

            rename($source . '/' . $file, $destination . '/' . $file);
        }
    }
}
