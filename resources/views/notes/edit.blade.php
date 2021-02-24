@extends('layouts.app')

@section('content')

<div class="container" style="padding-top:5%">
    <div>
        <p class="shadow-lg"><span><a href="{{route('notes.index')}}" >Back</a></span> Note : {{$note->note}}</p>

   </div>

</div>

<div class="container" style="padding-top: 2%">
    <form action="{{route('notes.update', $note->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="exampleFormControlInput1">Date</label>
          <input type="text" name="date" value="{{$note->date}}" class="form-control" placeholder="date note">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Hour</label>
            <input type="text" name="hour" value="{{$note->hour}}" class="form-control" placeholder="hour note">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="text" name="title" value="{{$note->title}}" class="form-control" placeholder="title note">
          </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Note</label>
          <textarea class="form-control" name="note" rows="3">
           {{$note->note}}
          </textarea>
        </div>

        <div class="form-group" >
            <button type="submit" class="btn btn-info m-3">Update</button>

        </div>
      </form>
</div>
<form>


@endsection
