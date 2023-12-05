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
                <h4 class="card-title">About</h4>
                <p class="card-description">
                    Please review ourselves
                </p>
                <a href="/backend/tentang/create" class="btn btn-primary mb-2">Tambah</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Telp</th>
                                <th scope="col">Email</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tentang as $t)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $t->lokasi }}</td>
                                    <td>{{ $t->telp }}</td>
                                    <td><a class="btn btn-link" href="{{$t->email}}" role="button">Email</a></td>
                                    <td>
                                        {{-- modal nya belum(?) --}}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $t->id_tentang }}">
                                            Read more...
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-{{ $t->id_tentang }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Tentang</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- <p>{{ $p->biografi }}</p> --}}
                                                        <textarea style="border: none; width:100%; line-height:200%" rows="10" readonly >{{ $t->deskripsi }}</textarea>
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
                                            <a href="/backend/tentang/edit/{{ $t->id_tentang }}"
                                                class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Update
                                                <i class="typcn typcn-edit btn-icon-append"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
