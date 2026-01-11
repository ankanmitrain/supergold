<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Admin\PdfData;

class GeneratePDF extends Controller
{
    
    /**
     * Display the specified resource.
     */
    public function GeneratePDF()
    {
        return view('admin.generatepdf');
    }

    /**
     * Display the specified resource.
     */
    public function GeneratePDFMobile()
    {
        return view('admin.generatepdfmobile');
    }


    public function storePDFData(Request $request)
    {
        PdfData::updateOrCreate(
            ['id' => 1],
            [
            'data' => $request->data   // array → stored as JSON
        ]);

        
        return response()->json(['message' => 'pdf data saved successfully']);
    }


    public function downloadMobilePdf(){

        $record = PdfData::findOrFail(1);
        //$data = json_decode($record->data, true);

        $data = $record->data;

       // print_r($data);

       return view('admin.pdf.template', compact('data'));

       
    }


}
