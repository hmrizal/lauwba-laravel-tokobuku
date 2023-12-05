@extends('backend.index')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add Social Media Account</h4>
        <p class="card-description">
            Input our social media accounts
        </p>
        <form action="/backend/sosmed/store" method="POST">
          @csrf
          <div class="form-group">
            <label for="facebook">Facebook</label>
            <input type="text" class="form-control" id="facebook" placeholder="Input our facebook link" name="facebook">
          </div>
          <div class="form-group">
            <label for="instagram">Instagram</label>
            <input type="text" class="form-control" id="instagram" placeholder="Input our instagram link" name="instagram">
          </div>
          <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" id="twitter" placeholder="Input our twitter link" name="twitter">
          </div>
          <div class="form-group">
            <label for="linkedin">Pinterest</label>
            <input type="text" class="form-control" id="linkedin" placeholder="Input our linkedin link" name="linkedin">
          </div>
          <div class="form-group">
            <label for="youtube">Youtube</label>
            <input type="text" class="form-control" id="youtube" placeholder="Input our youtube link" name="youtube">
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          {{-- <button class="btn btn-light">Cancel</button> --}}
        </form>
      </div>
    </div>
  </div>
@endsection
