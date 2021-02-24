@extends('layouts.app')

@section('content')

<div class="container" style="padding-top:5%">
    <div>
        <div>
          <p class="shadow-lg"><span><a href="{{route('notes.index')}}" >Back</a></span> Note : {{$note->note}}</p>
        </div>
      </div>

</div>

<div class="container" style="padding-top: 2%">

        <div class="form-group">
          <label for="exampleFormControlInput1">{{$note->date}}</label>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">{{$note->hour}}</label>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">{{$note->title}}</label>
          </div>

        <div class="form-group">
           {{$note->note}}

        </div>


</div>
<form>


@endsection
