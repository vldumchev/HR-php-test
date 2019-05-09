@extends('layouts.app')

@include('navigation')

@section('content')
<div class="container">
  @if (isset($error))
  <h1>{{ $error }}</h1>
  @else
  <h1 class="h2">Текущая температура в городе {{ $city }}, {{ $country }}:</h1>
  <p class="h2">{{ $temperature }}&#8451;</p>
  @endif
</div>
@endsection