@extends('layouts.main')

@section('title', 'Home Page')

@section('content')

<!-- BANNER -->
<div class="top-banner">
    <h1>Supper Gold Official Lottery Results</h1>
    <p class="lead mt-2">Fast · Accurate · Verified</p>
</div>

<!-- TODAY RESULTS SECTION -->
<section class="container" id="results">
    <div class="section-header">
        <h2>Today's Lottery Results</h2>
    </div>

    <div class="row g-4">
        

        <div class="col-md-6">
            <div class="result-card">
                <div class="result-title">SUPER GOLD DAY LOTTERY</div>
                <div class="result-time">1:30 PM Draw</div>
                <div class="draw-number">{{ \Carbon\Carbon::now('Asia/Kolkata')->format('l, F j, Y') }}</div>
                
                @if($pdfday)
                <a href="{{ Storage::url($pdfday->pdf_path) }}" class="download-btn mt-3 d-inline-block" target="_blank">Download Result PDF</a>
                @else
                <a class="download-btn mt-3 d-inline-block btn-warning" target="_blank">Waiting for the resault</a>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="result-card">
                <div class="result-title">SUPER GOLD EVENING LOTTERY</div>
                <div class="result-time">8:30 PM Draw</div>
                <div class="draw-number">{{ \Carbon\Carbon::now('Asia/Kolkata')->format('l, F j, Y') }}</div>
                @if($pdfevening)
                <a href="{{ Storage::url($pdfevening->pdf_path) }}" class="download-btn mt-3 d-inline-block" target="_blank">Download Result PDF</a>
                @else
                <a class="download-btn mt-3 d-inline-block btn-warning" target="_blank">Waiting for the resault</a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- WEEKLY SECTION 
<section class="container" id="weekly">
    <div class="section-header">
        <h2>Weekly Lottery Charts</h2>
    </div>
    <div class="row g-4">
        

        <div class="col-md-6">
            <div class="result-card">
                <div class="result-title">SUPER GOLD DAY LOTTERY</div>
                <div class="result-time">1:30 PM Draw</div>
                <div class="draw-number">{{ \Carbon\Carbon::now('Asia/Kolkata')->format('l, F j, Y') }}</div>
                <a href="#" class="download-btn mt-3 d-inline-block" target="_blank">Download Result PDF</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="result-card">
                <div class="result-title">SUPER GOLD EVENING LOTTERY</div>
                <div class="result-time">8:30 PM Draw</div>
                <div class="draw-number">{{ \Carbon\Carbon::now('Asia/Kolkata')->format('l, F j, Y') }}</div>
                <a href="#" class="download-btn mt-3 d-inline-block" target="_blank">Download Result PDF</a>
            </div>
        </div>
    </div>
</section>-->

@endsection