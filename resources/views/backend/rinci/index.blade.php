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
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-lg-16 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail</h4>
                <p class="card-description">
                    Please review detailed description for the books
                </p>
                <a href="/backend/rinci/create" class="btn btn-primary mb-2">Tambah</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Rilis</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Halaman</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Berat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailBuku as $detail)
                                <tr>
                                    <td>{{ $detail->id_detail }}</td>
                                    <td>{{ $detail->dasarBuku->judul }}</td>
                                    <td><img src="{{ Storage::url($detail->foto) }}" height="150px" target="_blank"></td>
                                    <td>{{ $detail->tanggal_rilis }}</td>
                                    <td>{{ $detail->penerbit }}</td>
                                    <td>{{ $detail->halaman }}</td>
                                    <td>{{ $detail->ukuran }}</td>
                                    <td>{{ $detail->berat }}g</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/backend/rinci/edit/{{ $detail->id_detail }}"
                                                class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Update
                                                <i class="typcn typcn-edit btn-icon-append"></i></a>
                                            <a href="/backend/rinci/delete/{{ $detail->id_detail }}"
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
                        {{$detailBuku->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
