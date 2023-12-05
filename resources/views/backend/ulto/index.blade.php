@extends('backend.index')
@section('content')
    {{-- kurang ini alertnya --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errors')->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-lg-16 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Store review</h4>
                <p class="card-description">
                    Please review our store review
                </p>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Review</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ulasantoko as $ulto)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $ulto->users->name}}</td>
                                    <td>
                                        {{-- modal nya belum(?) --}}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $ulto->id_ulto }}">
                                            Read more...
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-{{ $ulto->id_ulto }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Review</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea style="border: none; width:100%; line-height:200%" rows="10" readonly>{{ $ulto->ulasan }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/backend/ulasantoko/delete/{{ $ulto->id_ulto }}"
                                                class="btn btn-danger btn-sm btn-icon-text"
                                                onclick="return confirm ('Yakin delete?')">
                                                Delete
                                                <i class="typcn typcn-delete-outline btn-icon-append"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center mt-5">
                        {{$ulasantoko->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
