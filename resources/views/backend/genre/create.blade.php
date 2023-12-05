@extends('backend.index')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add Genre</h4>
        <p class="card-description">
            Input genre for the books
        </p>
        <form action="/backend/genre/store" method="POST">
          @csrf
          <div class="form-group">
            <label for="id_genre">ID</label>
            <input type="number" class="form-control" id="id_genre" placeholder="Input the ID" name="id_genre">
          </div>
          <div class="form-group">
            <label for="exampleSelectGender">Genre</label>
              <select class="form-select" id="exampleSelectGender" name="genre">
                <option selected>Select the genre</option>
                <option value="Fiction">Fiction</option>
                <option value="Nonfiction">Nonfiction</option>
              </select>
          </div>
          <div class="form-group">
            <label for="subgenre">Subgenre</label>
            <input type="text" class="form-control" id="subgenre" placeholder="Input the subgenre" name="subgenre">
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          {{-- <button class="btn btn-light">Cancel</button> --}}
        </form>
      </div>
    </div>
  </div>
@endsection
