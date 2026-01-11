@extends('adminlte::page')

@section('title', 'PDF Upload')

@section('content_header')
    <h1>Upload PDF</h1>
@stop

@section('content')

    <a href="{{ route('admin.uploadpdf.create') }}" class="btn btn-primary mb-3">Add PDF</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <!-- Search Filter -->
            <form action="{{ route('admin.uploadpdf.index') }}" method="GET" class="mb-3">
                <div class="row">
                <div class="col-md-3">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ request('title') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Publish Date</label>
                    <input type="date" name="publish_date" class="form-control"
                           value="{{ request('publish_date') }}">
                </div>
                <div class="col-md-3">
                    <label>Publish Time</label>
                    <input type="time" name="publish_time" class="form-control"
                           value="{{ request('publish_time') }}">
                </div>
                
                <div class="col-md-3">
                    <label>Select Option</label>
                    
                    <div class="form-check">
                            <input class="form-check-input" type="radio" name="enable_pdf" id="gridRadios1" value="1" {{ request('enable_pdf')==1 ? 'checked' : '' }} >
                            <label class="form-check-label" for="gridRadios1" > Enable </label>
                    </div>
                    <div class="form-check">
                            <input class="form-check-input" type="radio" name="enable_pdf" id="gridRadios1" value="0" {{ request('enable_pdf')!=null && request('enable_pdf')==0 ? 'checked' : '' }} >
                            <label class="form-check-label" for="gridRadios1"> Disable </label>
                    </div>
                    
                </div>
                </div>
                <div class="mt-3 field-group"><button class="btn btn-primary">Filter</button> &nbsp; <a href="{{ route('admin.uploadpdf.index') }}" class="btn btn-secondary">Reset</a></div>
                
                
            </form>
         </div>
        <div class="card-body p-0"> 
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Enabled</th>
                    <th>PDF</th>
                    <th>Actions</th>
                </tr>

                @foreach($documents as $doc)
                <tr>
                    <td>{{ $doc->id }}</td>
                    <td>{{ $doc->title }}</td>
                    <td>{{ $doc->publish_date }}</td>
                    <td>{{ $doc->publish_time }}</td>
                    <td>
                        @if($doc->enable_pdf)
                            <span class="badge badge-success">Yes</span>
                        @else
                            <span class="badge badge-danger">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $doc->pdf_path) }}" target="_blank" class="btn btn-info btn-sm">
                            View PDF
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.uploadpdf.edit', $doc->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('admin.uploadpdf.destroy', $doc->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete The PDF File?')" class="btn btn-danger btn-sm">Delete </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            {{ $documents->links('pagination::bootstrap-5') }}
        </div>
    </div>
@stop
