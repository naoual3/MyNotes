@extends('layouts.app')

@section('content')

<div class="container" style="padding-top:5%">

        <div>
          <p class="shadow-lg"><span><a href="{{route('notes.index')}}" >Back</a></span>Please add your note</p>
        </div>


</div>

<div class="container" style="padding-top: 2%">
    <form action="{{route('notes.store')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Date</label>
          <input type="text" name="date" class="form-control" placeholder="date note">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Hour</label>
            <input type="text" name="hour" class="form-control" placeholder="hour note">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="text" name="title" class="form-control" placeholder="title note">
          </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Note</label>
          <textarea class="form-control" name="note" rows="3"></textarea>
        </div>

        <div class="form-group" >
            <button type="submit" class="btn btn-info m-3">Save</button>

        </div>
      </form>
</div>
<form>


@endsection
