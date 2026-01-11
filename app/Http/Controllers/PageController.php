<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Admin\UploadPDF;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function LandingPage()
    {
        

        $pdfday = UploadPDF::where('enable_pdf', 1)
             ->where('publish_date', date('Y-m-d'))
             ->where('publish_time','01:30:00')
             ->first();

        $pdfevening = UploadPDF::where('enable_pdf', 1)
             ->where('publish_date', date('Y-m-d'))
             ->where('publish_time','08:30:00')
             ->first();

        return view('welcome', compact('pdfday','pdfevening'));
    }

    public function OldResaultPage(Request $request)
    {
        

        if ($request->filled('publish_date')) {

            $pdfall = UploadPDF::where('enable_pdf', 1)
             ->where('publish_date',$request->publish_date)
             ->orderBy('publish_date','desc')                          
             ->get();
           
        }else{

            $pdfall = UploadPDF::where('enable_pdf', 1)
             ->orderBy('publish_date','desc')  
             ->limit(20)              
             ->get();

        }

        

        

        return view('oldresault', compact('pdfall'));
    }

    public function AboutUsPage()
    {
        $page = Page::findOrFail(1);
        return view('innerpage', compact('page'));
    }

    public function ContractUsPage()
    {
        $page = Page::findOrFail(2);
        return view('innerpage', compact('page'));
    }

    public function SchemesPage()
    {
        $page = Page::findOrFail(3);
        return view('innerpage', compact('page'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Page::create($request->all());
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page->update($request->all());
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
