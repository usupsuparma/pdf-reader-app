<?php

namespace App\Http\Controllers;

use App\Models\EbookModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $ebooks = EbookModel::all();
        $data = [
            'ebooks' => $ebooks
        ];
        return view('dashboard', $data);
    }
}
