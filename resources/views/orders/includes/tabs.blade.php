@section('tabs')
<ul class="nav nav-tabs">
  @foreach ($groupedOrders as $type => $orders)
    <li class="{{ $type === 'expired' ? 'active' : '' }}">
      <a href="#{{ $type }}" data-toggle="tab">{{ __("orders.$type") }}</a>
    </li>
  @endforeach
</ul>

<div class="tab-content">
  @foreach ($groupedOrders as $type => $orders)
    <div class="tab-pane {{ $type === 'expired' ? 'active' : '' }}" id="{{ $type }}">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>ид_заказа</th>
            <th>название_партнера</th>
            <th>стоимость_заказа</th>
            <th>наименование_состав_заказа</th>
            <th>статус_заказа</th>
            <th>дата_доставки</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
            <tr>
              <td><a href="{{ route('orders.edit', ['id' => $order->id]) }}" target="_blank">{{ $order->id }}</a></td>
              <td>{{ $order->partner->name }}</td>
              <td>{{ $order->price }}</td>
              <td>
                <ul>
                  @foreach($order->products as $product)
                    <li>{{ $product->name }}</li>
                  @endforeach
                </ul>
              </td>
              <td>
                @switch ($order->status)
                  @case (0)
                    новый
                    @break

                  @case (10)
                    подтвержден
                    @break

                  @case (20)
                    завершен
                    @break

                  @default
                    не определён
                @endswitch
              </td>
              <td>{{ $order->delivery_dt }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5">Нет заказов</td>
            </tr>
          @endforelse
        <tbody>
      </table>
    </div>
  @endforeach
</div>
@endsection