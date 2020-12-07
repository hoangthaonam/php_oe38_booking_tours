$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function reply(cmr_id){
    let textarea = "<textarea id=\"content" + cmr_id + "\"></textarea>";
    let button = "<button data-url=\"/comment/create\" onClick=\"submit(this, " + cmr_id + ")\">Submit</button>";
    $( "#text"+cmr_id ).html(textarea + button);
}
function edit(cmr_id){
    let comment = $('#rootComment'+cmr_id).text();
    let textarea = "<textarea id=\"content" + cmr_id + "\">"+ comment +"</textarea>";
    let button = "<button data-url=\"/comment/update\" onClick=\"submit(this, " + cmr_id + ")\">Submit</button>";
    $('#rootComment'+cmr_id).html(textarea + button);
}
function submit(element, cmr_id = 0){
    let url = $(element).data('url');
    let content = $("#content"+cmr_id).val();
    let tour_id = parseInt($("#tour_id").val());
    let _token = $('#token').val();
    cmr_id = parseInt(cmr_id);
    let values = {
        'content': content,
        'tour_id': tour_id,
        'cmr_id': cmr_id,
        '_token': _token,
    };
    if(!content) {
        alert('Content is not null');
    } else{
        $.ajax({
            url: url,
            type: "POST",
            data: values,
            success: function(response){
                $( "#comments").html(response);
                $( "#content"+cmr_id).val('');
            }
        });
    }
}
function destroy(cmr_id){
    let url = "/comment/destroy";
    let _token = $('#token').val();
    let tour_id = parseInt($("#tour_id").val());
    cmr_id = parseInt(cmr_id);
    let values = {
        'cmr_id': cmr_id,
        'tour_id': tour_id,
        '_token': _token,
    };
    $.ajax({
        url: url,
        type: 'DELETE',
        data: values,
        success: function(response){
            $( "#comments").html(response);
        }
    });
}
function updateTotalPrice(element){
    let quantity_people = element.value;
    let price = document.getElementById("price").value;
    document.getElementById("total_price").innerHTML = price * quantity_people + "  VND";
    document.getElementById("amount").value = price * quantity_people;
}
function changePaymentMethod(element){
    let url = $(element).data('url');
    document.getElementById('book_form').action = url;
}
