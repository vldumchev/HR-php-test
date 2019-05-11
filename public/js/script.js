$('button[data-component="price-opener"]').on('click', (event) => {
  const modal = $('#modal-price')
  const form = modal.find('form')
  const { productName, productId } = event.target.parentNode.dataset

  form.attr('action', `${form.attr('data-price-base-url')}/${productId}`)

  modal.find('.modal-title').html(productName)
  modal.modal('show')
})

$('#modal-price form').submit(({ target }) => {
  event.preventDefault()

  $('#modal-price').modal('hide')

  const form = event.target;

  $.ajax({
    url: form.action,
    type: 'PATCH',
    data: $(target).serialize()
  }).done((response) => {
    $(`[data-product-id="${response.id}"] > [data-component="price"]`).html(response.price)
  })

  $(form).trigger('reset');
})
