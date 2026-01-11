<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UploadPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadPDFController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

            $query = UploadPDF::query();

            if ($request->title) {
                $query->where('title', 'like', '%' . $request->title . '%');
            }

            if ($request->publish_date) {
                $query->where('publish_date', $request->publish_date);
            }

            if ($request->publish_time) {
                $query->where('publish_time', $request->publish_time);
            }

            if ($request->enable_pdf !== null && $request->enable_pdf !== '') {
                $query->where('enable_pdf', $request->enable_pdf);
            }

                $documents = $query->latest()->paginate(10);
                return view('admin.uploadpdf.index', compact('documents'));
            }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.uploadpdf.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'pdf' => 'required|mimes:pdf|max:2048',
            'publish_date' => 'required|date',
            'publish_time' => 'required',
            'enable_pdf' => 'nullable',
        ]);

        $path = $request->file('pdf')->store('pdfs', 'public');

        UploadPDF::create([
            'title'        => $request->title,
            'pdf_path'     => $path,
            'publish_date' => $request->publish_date,
            'publish_time' => $request->publish_time,
            'enable_pdf'   => $request->has('enable_pdf') ? 1 : 0,
        ]);

        return redirect()->route('admin.uploadpdf.index')
            ->with('success', 'PDF uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UploadPDF $uploadPDF)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UploadPDF $uploadpdf)
    {
        return view('admin.uploadpdf.edit', compact('uploadpdf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UploadPDF $uploadpdf)
    {
         $validated = $request->validate([
            'title' => 'required',
            'pdf' => 'nullable|mimes:pdf|max:2048',
            'publish_date' => 'required|date',
            'publish_time' => 'required',
            'enable_pdf' => 'nullable',
        ]);

        $data = [
            'title' => $request->title,
            'publish_date' => $request->publish_date,
            'publish_time' => $request->publish_time,
            'enable_pdf' => $request->has('enable_pdf') ? 1 : 0,
        ];

        if ($request->hasFile('pdf')) {
            // delete old pdf
            Storage::disk('public')->delete($uploadpdf->pdf_path);

            // upload new pdf
            $data['pdf_path'] = $request->file('pdf')->store('pdfs', 'public');
        }

        $uploadpdf->update($data);

        return redirect()->route('admin.uploadpdf.index')
            ->with('success', 'PDF updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UploadPDF $uploadpdf)
    {

        Storage::disk('public')->delete($uploadpdf->pdf_path);
        $uploadpdf->delete();

        return redirect()->route('admin.uploadpdf.index')
            ->with('success', 'PDF deleted.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $request->file('file')->store('pdfs', 'public');

        return response()->json(['file' => $path]);
    }

}
