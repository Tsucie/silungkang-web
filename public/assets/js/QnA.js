const appUrl = $('meta[name="route"]').attr('content');
var edit = 0;

$(document).ready(function () {
    $('#header-title').text('Daftar QnA Bot Telegram');
});

// Modals for Show Details
function ShowDetails(obj) {
    let actionTitle = 'Informasi Pesan';
    $("#AddEditModal").on('show.bs.modal', function (e) {
        var modal = $(this);
        modal.find('.modal-title').text(actionTitle);
    });
    GetDetail(parseInt(obj.attributes.data_id.value), obj.attributes.data_nama.value);
}

function DisableBtn(selector) {
    $(selector).prop('disabled', true);
    $(selector).text('Tunggu ...');
}

function GetDetail(id) {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "GET",
        url: appUrl + "/QnA/" + id,
        contentType: "application/json",
        success: function (data) {
            if (data.code != null) {
                pesanAlert(data);
            }
            else {
                $('#fullname').val(data.fullname);
                $('#email').val(data.email);
                $('#question').val(data.message_text);
                $('#answer').val(data.jawaban);
                $('#msg_date').val(data.message_date);
                $("#AddEditModal").modal('show');
            }
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
        }
    });
}