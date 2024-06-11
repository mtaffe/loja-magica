const form = document.querySelector('form')
const selectClient = document.getElementById('clientId')

function handleSubmitMail(e) {
  e.preventDefault()

  const type = document.getElementById('type').value
  if (type == 'Order') {
    return handleSubmitOrderMail(e)
  }

  const { subject, message, } = form

  formData = {
    subject: subject.value,
    message: message.value,
  }

  const url = '/mail/sendStatement'

  $.ajax({
    url: url,
    method: 'POST',
    data: formData,
    success(data) {
      showNotification('success')
      console.log(data)
    },
    error(err) {
      showNotification('error')
      console.log(err)
    }
  })
}

function handleSubmitOrderMail(e){
  e.preventDefault()

  const { subject, message, } = form

  formData = {
    subject: subject.value,
    message: message.value,
    orderId: document.getElementById('orderId').value,
    orderStatus: document.getElementById('orderStatus').value,
    clientId: document.getElementById('clientId').value
  }
  
  const url = '/mail/sendOrderStatus'

  $.ajax({
    url: url,
    method: 'POST',
    data: formData,
    success(reponse) {
      data = JSON.parse(reponse)
      if (data.success){
        showNotification('success')
        return
      }
      if (data.error){
        showNotification('error')
        return
      }      
      console.log(JSON.parse(data))
    },
    error(err) {
      showNotification('error')
      console.log(err)
    }
  })
}

function fetchOrders(e) {

  const { clientId } = form
  console.log(clientId.value)

  const url = '/order/client/' + clientId.value
  $.ajax({
    url: url,
    method: 'POST',
    success(response) {
      data = JSON.parse(response)
      let orderSelect = document.getElementById('orderId')
      $("#orderId").find('option').remove()

      for (var i = 0; i < data.orders.length; i++) {
        orderSelect.innerHTML += '<option value="' + data.orders[i].id + '">' + data.orders[i].product + '</option>'
        $("#orderId").prop("disabled", false);
        $("#orderStatus").prop("disabled", false);
        $("#orderStatus").val(data.orders[i].status).change()
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
  }, 3000); // Oculta a notificação após 3 segundos
}


form.addEventListener('submit', handleSubmitMail)
if(selectClient) {
  selectClient.addEventListener('change', fetchOrders)
}
