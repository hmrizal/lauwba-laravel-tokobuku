@extends('backend.index')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add About</h4>
        <p class="card-description">
            Input about
        </p>
        <form action="/backend/tentang/store" method="POST">
          @csrf
          <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" placeholder="Insert the address" name="lokasi">
          </div>
          <div class="form-group">
            <label for="telp">Telepon</label>
            <input type="text" class="form-control" id="telp" placeholder="Input phone number" name="telp">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" placeholder="Input email" name="email">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" cols="50" rows="10"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          {{-- <button class="btn btn-light">Cancel</button> --}}
        </form>
      </div>
    </div>
  </div>
@endsection
