@extends('backend.index')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Author</h4>
                <p class="card-description">
                    Edit author for the books
                </p>
                <form action="/backend/penulis/update/{{ $penulis->id_penulis }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_genre">ID</label>
                        <input class="form-control" type="number" name="id_penulis" value="{{ $penulis->id_penulis }}"
                            aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="displayGambarPenulis">Foto</label>
                        <input type="file" name="foto" class="form-control" onchange="GambarPenulis(event)"><img
                            src="{{ Storage::url($penulis->foto) }}" width="100px" target="_blank"
                            id="displayGambarPenulis">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Input the name"
                            name="nama" value="{{ $penulis->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Biografi</label>
                        <textarea name="biografi" class="form-control" cols="50" rows="10">{{ $penulis->biografi }}</textarea>
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
        const displayGambarPenulis = document.getElementById('displayGambarPenulis');
        displayGambarPenulis.src = "/public/foto_penulis";
        // #####---------

        // function untuk menampilkan gambar pada saat setelah di pilih dari galery
        function GambarPenulis(event) {
            // ambil data eventnya
            const eventGambar = event.target.files;
            // kemudian tambahkan attribut src nya seperti <img src="link disini dari javacript">
            // atur src dengan nama file yang ada di filegambar[0]
            displayGambarPenulis.src = URL.createObjectURL(eventGambar[0]);
            // // kemudian
            displayGambarPenulis.style.display = "block";
        }
    </script>
@endsection
