const form = document.querySelector('form')
const typeClient = document.getElementById('typeClient')

function handleSubmitOrder(e) {
  e.preventDefault()

  const { orderId, client_id, product, quantity, status } = form

  const formData = {
    client_id: client_id.value,
    product: product.value,
    quantity: quantity.value,
    status: status.value
  }

  const url = action.value == 'edit' ? "/order/update/" + orderId.value : "/order/store"

  $.ajax({
    url: url,
    method: 'POST',
    data: formData,
    success: function(response){
      console.log(response)
      data = JSON.parse(response)
      if (data.error) {
        showNotification('error')
        console.log(data.error)
      } else if (data.success) {
        showNotification('success')
        console.log(data.success)
      }
    },
    error(err) {
      console.log(err)
    }
  })
}


function showNotification(type) {
  let notification;
  if (type === 'success') {
      notification = $('#notificationSuccess');
  } else if (type === 'error') {
      notification = $('#notificationError');
  }

  notification.addClass('show');
  setTimeout(function() {
      notification.removeClass('show');
  }, 3000);
}

form.addEventListener('submit', handleSubmitOrder)