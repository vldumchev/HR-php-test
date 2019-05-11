@extends('layouts.app')

@include('navigation')

@section('content')
<div class="container">
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>ид_продукта</th>
        <th>наименование_продукта</th>
        <th>наименование_поставщика</th>
        <th>цена</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($products as $product)
        <tr>
          <td>{{ $product->id }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->vendor->name }}</td>
          <td data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
            <span data-component="price">{{ $product->price }}</span> 
            <button type="button" class="btn btn-link btn-xs" data-component="price-opener">ред.</button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5">Нет продуктов</td>
        </tr>
      @endforelse
    <tbody>
  </table>
  {{ $products->links() }}
</div>

<div id="modal-price" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form action="" data-price-base-url="{{ route('api.products.update') }}">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
          <div class="form-group">
            <label>Новая цена</label>
            <input type="text" class="form-control" name="price" />
          </div>
          <button type="submit" class="btn btn-success">Обновить</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection