@extends('layouts.main')

@section('title', 'Home Page')

@section('content')

<!-- BANNER -->
<div class="top-banner">
    <h1>Super Gold Official Lottery Results</h1>
    <p class="lead mt-2">Fast · Accurate · Verified</p>
</div>

@if($pdfall)
<!-- TODAY RESULTS SECTION -->
<section class="container" id="results">
    <div class="section-header">
        <h2 class="old-resault-heading">Today's and Previous  Days Lottery Results</h2>

        <div class="row">
            <div class="col-6 mx-auto filter-section">
               

                    <div class="callender-container" style="width: auto;">
                         <form method="GET" action="{{ route('oldlotteryresault') }}">
                            <table width="100%">
                                <tr>
                                    <td><label><b>Select Date</b></label></td>
                                    <td>                                     

                                        <div class="input-group date" id="publish_date_picker">
                                            
                                            <input type="text" name="publish_date" class="form-control" value="{{ request('publish_date') }}" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text callender-icon"><i class="fa-regular fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-primary">Filter</button></td>
                                    <td><a href="{{ route('oldlotteryresault') }}" class="btn btn-secondary">Reset</button></td>

                                </tr>
                            </table>
                        
                        </form>
                    </div>

                
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        @foreach ($pdfall as $item)
        <div class="col-md-6">
            <div class="result-card">
                <div class="result-title">@if($item->publish_time=='01:30:00' || $item->publish_time=='13:30:00') SUPER GOLD DAY LOTTERY @elseif($item->publish_time=='08:30:00' || $item->publish_time=='20:30:00') SUPER GOLD EVENING LOTTERY @else SUPER GOLD BAMPER LOTTERY @endif</div>
                <div class="result-time">@if($item->publish_time=='01:30:00' || $item->publish_time=='13:30:00') 1:30 PM Draw @elseif($item->publish_time=='08:30:00' || $item->publish_time=='20:30:00') 8:30 PM Draw @else 
                    {{ \Carbon\Carbon::parse($item->publish_time)->format('h:i A') }}  @endif </div>
                <div class="draw-number">{{ \Carbon\Carbon::parse($item->publish_date)->format('l, F j, Y') }}</div>

                @if($item->pdf_path)
                <a href="{{ Storage::url($item->pdf_path) }}" class="download-btn mt-3 d-inline-block" target="_blank">Download Result PDF</a>
                @else
                <a href="#" class="download-btn mt-3 d-inline-block btn-warning" target="_blank">Waiting for the resault</a>
                @endif                
            </div>
        </div>
        @endforeach
       
    </div>
</section>

@endif

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endpush

@push('js')
<script>
jQuery('#publish_date_picker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    defaultViewDate: new Date(),
    clearBtn: true
});
</script>
@endpush

@endsection




