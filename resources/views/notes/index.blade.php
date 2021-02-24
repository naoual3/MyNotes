@extends('layouts.app')

@section('content')

<nav class=" container navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">My Notes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  </nav>
<div class="jumbotron container">
    <p class="shadow-lg mt-5">Please create your note</p>
    <a class="btn btn-info btn-sm" href="{{route('notes.create')}}" role="button">Create</a>
  </div>

  <div class="container" style="padding-top: 3%">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">Hour</th>
          <th scope="col">Title</th>
          <th scope="col">Note</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

    </div>

            @php
                $i =0;
            @endphp
            @foreach($notes as $item)
            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{$item->date}}</td>
                <td>{{$item->hour}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->note}}</td>
                <td>
                  <div class="row">
                    <div class="col-sm">
                      <a class="btn btn-outline-primary" href="{{route('notes.edit' ,$item->id)}}">Edit</a>

                    </div>
                    <div class="col-sm">
                      <a class="btn btn-outline-warning" href="{{route('notes.show',$item->id)}}"> Show</a>

                    </div>
                    <div class="col-sm">
                      <form action="{{route('notes.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger "> Delete</button>
                        </form>
                    </div>
                  </div>

                </td>
              </tr>
            @endforeach

        </tbody>
      </table>
  </div>

@endsection
