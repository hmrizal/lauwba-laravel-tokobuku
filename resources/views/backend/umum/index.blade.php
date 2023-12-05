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
                <h4 class="card-title">General</h4>
                <p class="card-description">
                    Please review general description for the books
                </p>
                <a href="/backend/umum/create" class="btn btn-primary mb-2">Tambah</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Harga Asli</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Sinopsis</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dasarBuku as $dasar)
                                <tr>
                                    <td>{{ $dasar->id_buku }}</td>
                                    <td>{{ $dasar->judul }}</td>
                                    <td>{{ $dasar->penulis->nama }}</td>
                                    <td>{{ $dasar->genre->subgenre }}</td>
                                    <td>@rupiah($dasar->harga_asli)</td>
                                    @if ($dasar->diskon > 0)
                                        <td>{{ $dasar->diskon }}%</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $dasar->stok }}</td>
                                    <td>
                                        {{-- modal nya belum(?) --}}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $dasar->id_buku }}">
                                            Read more...
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-{{ $dasar->id_buku }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $dasar->judul }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea style="border: none; width:100%; line-height:200%" rows="10" readonly>{{ $dasar->sinopsis }}</textarea>
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
                                            <a href="/backend/umum/edit/{{ $dasar->id_buku }}"
                                                class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Update
                                                <i class="typcn typcn-edit btn-icon-append"></i></a>
                                            <a href="/backend/umum/delete/{{ $dasar->id_buku }}"
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
                        {{$dasarBuku->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
