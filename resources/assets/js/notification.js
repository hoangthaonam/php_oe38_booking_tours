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
        <a class="float-right" data-id=${data.id} data-user="0" onClick="markAsRead(this)">
            Mark as read
        </a>
        <hr>
    </div>
    `;
    var newNotificationHtmlUser = `
    <div id="noti${data.id}" class="p-1">
        <a class="nav-link bg-info text-white" href="http://127.0.0.1:8000/payment/${data.payment_id}">
            <span>${data.title}</span><br>
            <small>${data.content}</small>
        </a>
        <a class="float-right" data-id=${data.id} data-user="1" onClick="markAsRead(this)">
            Mark as read
        </a>
        <br>
        <hr>
    </div>
    `;
    $('#numberOfUnReadNotification').removeClass("hidden");
    $('#numberOfUnReadNotification').html(data.numberOfUnReadNotification);
    $('#list_notifications').prepend(newNotificationHtml);
    $('.menu-notification-user').prepend(newNotificationHtmlUser);
});

function markAsRead(element){
    let id = $(element).data('id');
    let user = $(element).data('user');
    let _token = $('#token').val();
    let numberOfUnReadNotification = $('#numberOfUnReadNotification').html() - 1;
    let values = {
        'id': id,
        '_token': _token,
    };
    $.ajax({
        url: 'http://127.0.0.1:8000/notification/markAsRead/'+ id + '/' + user,
        type: "GET",
        data: values,
        success: function(response){
            document.getElementById('noti'+id).innerHTML = response;
            document.getElementById('numberOfUnReadNotification').innerHTML = numberOfUnReadNotification;
            if(numberOfUnReadNotification == 0){
                document.getElementById('numberOfUnReadNotification').classList.add("hidden");
            }
        }
    });
}

function markAllAsRead(element){
    let user = $(element).data('user');
    let _token = $('#token').val();
    let values = {
        '_token': _token,
    };
    $.ajax({
        url: 'http://127.0.0.1:8000/notification/markAllAsRead/'+ user,
        type: "GET",
        data: values,
        success: function(response){
            document.getElementById('list_notifications').innerHTML = response;
            document.getElementById('numberOfUnReadNotification').classList.add("hidden");
        }
    });
}
