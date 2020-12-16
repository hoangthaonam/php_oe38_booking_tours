var pusher = new Pusher('67b0a7b5cdbb53ee357a', {
    encrypted: true,
    cluster: "ap1"
});

var channel = pusher.subscribe('NotificationEvent');
channel.bind('send-message', function(data) {
    var newNotificationHtml = `
    <div id="noti${data.id}">
        <a class="dropdown-item bg-info text-white" href="http://127.0.0.1:8000/admin/payment/${data.payment_id}">
            <span>${data.title}</span><br>
            <small>${data.content}</small>
        </a>
        <a class="float-right" data-id=${data.id} onClick="markAsRead(this)">
            Mark as read
        </a>
        <hr>
    </div>
    `;

    $('.menu-notification').prepend(newNotificationHtml);
});

function markAsRead(element){
    let id = $(element).data('id');
    let _token = $('#token').val();
    let values = {
        'id': id,
        '_token': _token,
    };
    $.ajax({
        url: 'http://127.0.0.1:8000/notification/markAsRead/'+id,
        type: "GET",
        data: values,
        success: function(response){
            document.getElementById('noti'+id).innerHTML = response;
        }
    });
}
