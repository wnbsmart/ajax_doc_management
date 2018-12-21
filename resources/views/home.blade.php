@extends('layouts.app')

@section('custom-style')
    <style>
        .form-control{  min-height: 50px;}
        .ul{list-style-type: none;}
        .help-block{color:#dc3545;}
        .border {border:1px solid #dee2e6 !important;
            border-top-color: rgb(222, 226, 230);
            border-right-color: rgb(222, 226, 230);
            border-bottom-color: rgb(222, 226, 230);
            border-left-color: rgb(222, 226, 230);
        }
        .border-danger{border-color: #dc3545 !important;}
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Dobrodošli, {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>

   @include('includes.errors')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="alert" id="message1" style="display: none"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Vaši dokumenti
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadModal" style="float:right;">
                        <i class="fas fa-plus"></i> Novi unos/Upload
                    </button>
                </div>
                <div class="panel-body">
                    <table class="table" id="docs_table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Dokument</th>
                                <th scope="col">Uredi</th>
                                <th scope="col">Izbriši</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($docs as $doc)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>
                                    <form action="{{ route('show_file', ['id' => $doc->id]) }}" id="editFile" method="post">
                                        {{ @csrf_field() }}
                                        <button class="btn btn-link doc_name" type="submit" data-id="{{ $doc->id }}">
                                            {{ $doc->type->name }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-link edit-btn" data-toggle="modal"
                                            data-target="#editModal" data-id="{{ $doc->id }}" value="{{ $doc->type_id }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </td>
                                <td>
                                    <form method="post" class="form-delete">
                                        {{ @csrf_field() }}
                                        {{  method_field('delete') }}
                                        <button class="btn btn-link delete" type="submit" value="{{ $doc->id }}"
                                                onclick="return confirm('Brisati? Da li ste sigurni?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.modals')
@endsection

@section('scripts')
    <script src="{{ asset('js/upload-file.js') }}"></script>
    <script src="{{ asset('js/delete-file.js') }}"></script>
    <script src="{{ asset('js/edit-file.js') }}"></script>
@endsection