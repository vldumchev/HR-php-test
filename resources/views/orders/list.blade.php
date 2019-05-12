@extends('layouts.app')

@include('navigation')
@include('orders.includes.tabs')

@section('content')
<div class="container">
  @yield('tabs')
</div>
@endsection