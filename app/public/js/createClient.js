const form = document.querySelector('form')
const result = document.querySelector('.result')

function handleSubmitClient(e) {
  e.preventDefault()

  const { name, email, last_order_date, type, last_order_cost, action, clientId} = form

  const formData = {
    name: name.value,
    email: email.value,
    type: type.value,
    last_order_date: last_order_date.value,
    last_order_cost: last_order_cost.value
  }

  const url = action.value == 'edit' ? "/client/update/"+clientId.value : "/client/store"

  $.ajax({
    url: url,
    method: 'POST',
    data: formData,
    success: function(response) {
      data = JSON.parse(response)
      console.log(response)
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
  setTimeout(function () {
      notification.removeClass('show');
  }, 3000);
}


form.addEventListener('submit', handleSubmitClient)