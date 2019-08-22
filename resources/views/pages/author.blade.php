@extends('inc.app')

@section('content')
<div class="container">
  <div class="jumbotron jumbotron-fluid text-center ">
    <div class="container">
      <h1 class="dislpay-3">
        {{$author}}
      </h1>

    </div>
  </div>
  @foreach ($articles as $article)
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h2>
        {{ $article->title }}
      </h2>
      <p class="lead">
        {{ $article->content }}
      </p>
    </div>
  </div>
  @endforeach
  {{ $articles->links() }}
</div>
@endsection