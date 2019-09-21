<?php

namespace App\Http\Controllers;

use App\Imports\CsvImport;
use App\Exports\CsvExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Alert;

class CsvFileController extends Controller
{
    public function index()
    {
        return view('csvfile/index');
    }

    public function csv_export()
    {
        return Excel::download(new CsvExport, 'sample.csv');
    }

    public function csv_import()
    {
        Excel::import(new CsvImport, request()->file('file'));
        Alert::success('File berhasil di Import!!!', 'Suksesss!!!');
        return redirect()->route('eksportData');
    }
}
