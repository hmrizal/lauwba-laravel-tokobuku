@extends('backend.index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Book Details</h4>
                <p class="card-description">
                    Input detailed description for the books
                </p>
                <form action="/backend/rinci/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_detail">ID</label>
                        <input type="number" class="form-control" id="id_detail" placeholder="Input the ID"
                            name="id_detail">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Judul</label>
                        <select class="form-select" id="exampleSelectGender" name="id_buku">
                            <option selected>Select the judul</option>
                            @foreach ($dasarBuku as $ds)
                                <option value="{{ $ds->id_buku }}">{{ $ds->id_buku }} - {{ $ds->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="displayCoverBuku">Foto</label>
                        <input type="file" class="form-control" placeholder="Insert the book cover" name="foto"
                            onchange="CoverBuku(event)">
                        <img id="displayCoverBuku" width="100px" height="150px" class="rounded">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_rilis">Tanggal Rilis</label>
                        <input type="date" class="form-control" id="tanggal_rilis"
                            placeholder="Input the release date of the book" name="tanggal_rilis">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" placeholder="Input the publisher"
                            name="penerbit">
                    </div>
                    <div class="form-group">
                        <label for="halaman">Jumlah halaman</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="halaman"
                                placeholder="Input the number of pages" name="halaman">
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary text-white">halaman</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ukuran">Ukuran</label>
                        <input type="text" class="form-control" id="ukuran" placeholder="Input the dimension"
                            name="ukuran">
                    </div>
                    <div class="form-group">
                        <label for="berat">Berat</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="berat"
                                placeholder="Input the weight of the book (in grams)" name="berat">
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary text-white">gram</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    {{-- <button class="btn btn-light">Cancel</button> --}}
                </form>
            </div>
        </div>
    </div>
    <script>
        // kondisi pertama pada saat halaman di load, tampilkan gambar di tag <img> dengan data gambar pada database
        // panggil id gambar dari tag <img>, ini untuk menampilkan gambarnya
        const displayCoverBuku = document.getElementById('displayCoverBuku');
        displayCoverBuku.src = "/public/cover_buku";
        // #####---------

        // function untuk menampilkan gambar pada saat setelah di pilih dari galery
        function CoverBuku(event) {
            // ambil data eventnya
            const eventGambar = event.target.files;
            // kemudian tambahkan attribut src nya seperti <img src="link disini dari javacript">
            // atur src dengan nama file yang ada di filegambar[0]
            displayCoverBuku.src = URL.createObjectURL(eventGambar[0]);
            // // kemudian
            displayCoverBuku.style.display = "block";
        }
    </script>
@endsection
