var deleteModal = document.getElementById('deleteModal')
deleteModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var clientId = button.getAttribute('data-bs-client-id')
    var clientName = button.getAttribute('data-bs-client-name')

    var modalBodyInput = deleteModal.querySelector('.modal-body')
    var deleteClientBtn = deleteModal.querySelector('#deleteClientBtn')

    modalBodyInput.textContent = 'Deseja prosseguir com a exclusão do cliente ' + clientName + '?'
    deleteClientBtn.addEventListener('click', () => deleteClient(clientId))
})

function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function deleteClient(id) {
    const url = "/client/delete/" + id

    $.ajax({
        url: url,
        method: 'POST',
        success(response) {
            data = JSON.parse(response)
            if (data.error) {
                showNotification('error')
                console.log(data.error)
            } else if (data.success) {
                showNotification('success')
                window.location.href = "/client/"
                console.log(data.success)
            }
        },
        error(err) {
            console.log(err)
        }
    })
}

function editClient(id) {
    window.location.href = "/client/" + id
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
