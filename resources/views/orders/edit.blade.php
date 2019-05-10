@extends('layouts.app')

@include('navigation')

@section('content')
<div class="container">
  <form action="{{ route('orders.update', ['id' => $order->id]) }}" method="POST">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}

    <div class="form-group {{ isset($errors['email']) ? 'has-error' : '' }}">
      <label class="control-label">Email клиента</label>
      <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $order->client_email }}" required />
      @isset ($errors['email'])
        <span class="help-block">{{ $errors['email'] }}</span>
      @endisset
    </div>

    <div class="form-group {{ isset($errors['partner']) ? 'has-error' : '' }}">
      <label>Партнёр</label>
      <select class="form-control" name="partner" required>
        @foreach ($partners as $partner)
          @if ($partner->id === $order->partner_id)
            <option value="{{ $partner->id }}" selected>{{ $partner->name }}</option>
          @else
            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
          @endif
        @endforeach
      </select>
      @isset ($errors['partner'])
        <span class="help-block">{{ $errors['partner'] }}</span>
      @endisset
    </div>

    <div class="form-group">
      <label>Продукты</label>
      <ul class="list-unstyled">
        @php
          $products = $order->products->reduce(function ($carry, $item) {
            if (isset($carry[$item->name])) {
              $carry[$item->name]++;
            } else {
              $carry[$item->name] = 1;
            }

            return $carry;
          }, []);
        @endphp

        @foreach($products as $key => $value)
        <li>{{ $key }} &times; {{ $value }}</li>
        @endforeach
      </ul>
    </div>

    <div class="form-group {{ isset($errors['status']) ? 'has-error' : '' }}">
      <label>Статус заказа</label>
      <select class="form-control" name="status" required>
        @php
          $statuses = [
            '0'  => 'новый',
            '10' => 'подтвержден',
            '20' => 'завершен'
          ];
        @endphp

        @foreach ($statuses as $key => $value)
          @if ($key === $order->status)
            <option value="{{ $key }}" selected>{{ $value }}</option>
          @else
            <option value="{{ $key }}">{{ $value }}</option>
          @endif
        @endforeach
      </select>
      @isset ($errors['status'])
        <span class="help-block">{{ $errors['status'] }}</span>
      @endisset
    </div>

    <div class="form-group">
      <label>Стоимость заказ</label>
      <p>{{ $order->price }}</p>
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
  </form>
</div>
@endsection