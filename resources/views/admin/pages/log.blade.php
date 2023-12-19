@extends('admin.template')

@section('title', 'log')

@section('css')
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
@endsection

@section('main-content')
    <div class="page-heading">
        <h3>Tepian Dashboard</h3>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Log - Tepian Kuis</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.log') }}" method="GET">
                    <div class="form-group">
                        <label for="date">Filter by Date:</label>
                        <input type="date" id="date" name="date" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
                <br>
                <pre>{{!! $logContent !!}}</pre>
            </div>
        </div>
    </div>
@endsection


@section('js')
@endsection
