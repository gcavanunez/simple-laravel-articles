@extends('inc.app')

@section('content')
<div class="container">
  <div class="jumbotron jumbotron-fluid ">
    <div class="container pr-5 pl-5">
      <h1 class="dislpay-4">
        {{$title}}
      </h1>
      <p class="lead">
        {{$description}}
      </p>
    </div>
  </div>
</div>
@endsection