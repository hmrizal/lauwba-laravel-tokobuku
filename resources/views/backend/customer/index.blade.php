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
                <h4 class="card-title">Customer</h4>
                <p class="card-description">
                    Please review the customer
                </p>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer as $c)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$c->name}}</td>
                                    <td><a class="btn btn-link" href="{{$c->email}}" role="button">Email</a></td>
                                    <td><a class="btn btn-link" href="{{$c->password}}" role="button">Password</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/backend/customer/delete/{{ $c->id }}"
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
                        {{$customer->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
