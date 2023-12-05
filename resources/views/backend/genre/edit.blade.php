@extends('backend.index')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Update Genre</h4>
        <p class="card-description">
            Update genre for the books
        </p>
        <form action="/backend/genre/update/{{$genre->id_genre}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="id_genre">ID</label>
                <input class="form-control" type="number" name="id_genre" value="{{$genre->id_genre}}" aria-label="Disabled input example" disabled readonly>
          </div>
          <div class="form-group">
            <label for="exampleSelectGender">Genre</label>
              <select class="form-select" id="exampleSelectGender" name="genre">
                <option selected>Edit the genre</option>
                <option value="Fiction" {{$genre->genre == 'Fiction' ? 'selected' : ''}}>Fiction</option>
                <option value="Nonfiction" {{$genre->genre == 'Nonfiction' ? 'selected' : ''}}>Nonfiction</option>
              </select>
          </div>
          <div class="form-group">
            <label for="subgenre">Subgenre</label>
            <input type="text" class="form-control" id="subgenre" placeholder="Input the subgenre" name="subgenre" value="{{$genre->subgenre}}">
          </div>
          <button type="submit" class="btn btn-primary mr-2">Update</button>
          {{-- <button class="btn btn-light">Cancel</button> --}}
        </form>
      </div>
    </div>
  </div>
@endsection
