@extends('inc.app')

@section('content')
<div class="container">
  <div class="jumbotron jumbotron-fluid text-center ">
    <div class="container">
      <h1 class="dislpay-3">
        <img src="/img/nucliuzMVC-logo.png" id="jumbo-logo" style="">
        {{$title}}
      </h1>
      <p class="lead">
        {{$description}}
      </p>
    </div>
  </div>
</div>
@endsection