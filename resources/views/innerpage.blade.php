@extends('layouts.main')

@section('title', 'Home Page')

@section('content')


<!-- INNER PAGE BANNER -->
<div class="inner-banner">
    <h1>{{ $page->title ?? 'Page Title' }}</h1>
    <p class="lead mt-2">{{ $page->subtitle ?? '' }}</p>
</div>

<!-- CONTENT SECTION -->
<div class="container">
    <div class="content-box">
        {!! $page->content ?? '<p>Your CMS content will appear here.</p>' !!}
    </div>
</div>




@endsection