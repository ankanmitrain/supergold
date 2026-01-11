@extends('adminlte::page')

@section('title', 'Page Content')

@section('content_header')
    <h1>Pages</h1>
@stop

@section('content')
    <!--<a href="{{ route('admin.pages.create') }}" class="btn btn-primary mb-3">Add Page</a>-->

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Title</th>
            
            <th>Actions</th>
        </tr>

        @foreach($pages as $page)
        <tr>
            <td>{{ $page->id }}</td>
            <td>{{ $page->title }}</td>            
           
            
            <td>
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning btn-sm">Edit</a>
                
                <!--<form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Delete The Page File?')" class="btn btn-danger btn-sm">Delete </button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </table>
@stop
