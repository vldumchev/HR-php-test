@section('navigation')
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <a href="{{ route('current-temperature', ['country' => 'Россия', 'city' => 'Брянск']) }}">Температура в Брянске</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
@endsection