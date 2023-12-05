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
                <h4 class="card-title">Social Media</h4>
                <p class="card-description">
                    Please review our social media account
                </p>
                <a href="/backend/sosmed/create" class="btn btn-primary mb-2">Tambah</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Facebook</th>
                                <th scope="col">Instagram</th>
                                <th scope="col">Twitter</th>
                                <th scope="col">Linkedin</th>
                                <th scope="col">Youtube</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sosmed as $sm)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a class="btn btn-link" href="{{$sm->facebook}}" role="button">Facebook</a></td>
                                    <td><a class="btn btn-link" href="{{$sm->instagram}}" role="button">Instagram</a></td>
                                    <td><a class="btn btn-link" href="{{$sm->twitter}}" role="button">Twitter</a></td>
                                    <td><a class="btn btn-link" href="{{$sm->linkedin}}" role="button">Linkedin</a></td>
                                    <td><a class="btn btn-link" href="{{$sm->youtube}}" role="button">Youtube</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/backend/sosmed/edit/{{ $sm->id_sosmed }}"
                                                class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Update
                                                <i class="typcn typcn-edit btn-icon-append"></i></a>
                                            <a href="/backend/sosmed/delete/{{ $sm->id_sosmed }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection
