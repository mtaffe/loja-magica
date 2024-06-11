const form = document.querySelector('form')
const result = document.querySelector('.result')

async function ajax(config) {
  try {
    const request = await fetch(config.url, config.headers)
    const response = await request.json()
    config.success(response)
  } catch (err) {
    config.error(err)
  }
}

function handleImplort(e) {
    e.preventDefault()
  
    const { file } = form
  
    const formData = new FormData(this)
    formData.append('file', file.value)
  
    ajax({
      url: '/import',
      headers: {
        body: formData,
        method: 'POST'
      },
      success: function(response) {
        data = response
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
  
  
  form.addEventListener('submit', handleImplort)