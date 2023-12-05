@extends('backend.index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Books</h4>
                <p class="card-description">
                    Input basic description for the books
                </p>
                <form action="/backend/umum/store" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_buku">ID</label>
                        <input type="number" class="form-control" id="id_buku" placeholder="Input the ID" name="id_buku">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" placeholder="Insert the book title" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Author</label>
                        <select class="form-select" id="exampleSelectGender" name="id_penulis">
                            <option selected>Select the author</option>
                            @foreach ($penulis as $p)
                            <option value="{{$p->id_penulis}}">{{$p->id_penulis}} - {{$p->nama}}</option>
                            @endforeach
                        </select>
                        {{-- @error('id_penulis')
                        <div class="alert alert-danger">{{$message}}</div>

                        @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Genre</label>
                        <select class="form-select" id="exampleSelectGender" name="id_genre">
                            <option selected>Select the genre</option>
                            @foreach ($genre as $g)
                            <option value="{{$g->id_genre}}">{{$g->id_genre}} - {{$g->subgenre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_asli">Harga Asli</label>
                        <input type="number" class="form-control" id="harga_asli" placeholder="Input the original price"
                            name="harga_asli">
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="diskon" placeholder="Input the discount" name="diskon">
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary text-white">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" placeholder="Input the amount of stock"
                            name="stok">
                    </div>
                    <div class="form-group">
                        <label for="nama">Sinopsis</label>
                        <textarea name="sinopsis" class="form-control" cols="50" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    {{-- <button class="btn btn-light">Cancel</button> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
