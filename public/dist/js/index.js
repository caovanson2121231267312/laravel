// $(document).ready(function() {
// $('#langs').on('change', function() {
// var selectedLang = $(this).val();
// $.ajax({
// url: '/your-endpoint',
// type: 'POST',
// data: {
// lang: selectedLang
// },
// headers: {
// 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// },
// success: function(response) {
// // Handle success response
// console.log(response);
// // Optionally, reload the page or update part of the page
// },
// error: function(xhr, status, error) {
// // Handle error response
// console.error(xhr.responseText);
// }
// });
// });
// });

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

var alert_mess = document.querySelectorAll(".alert-mess");
for (var i = 0; i < alert_mess.length; i++) {
    Swal.fire({
        title: "Thông báo!",
        html: `${alert_mess[i].innerHTML}`,
        timer: 8000,
        timerProgressBar: true,
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
        }
    });
}

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
    "progressBar": true,
}

var alert_success = document.querySelectorAll("#code-alert-success");
for (var i = 0; i < alert_success.length; i++) {
    toastr.success(alert_success[i].innerHTML)
}

var alert_error = document.querySelectorAll("#code-alert-error");
for (var i = 0; i < alert_error.length; i++) {
    toastr.error(alert_error[i].innerHTML)
}

var alert_info = document.querySelectorAll("#code-alert-info");
for (var i = 0; i < alert_info.length; i++) {
    toastr.warning(alert_info[i].innerHTML)
}

// kiểm tra lỗi responce gửi lên
function check_message_error(error, type_form = "create") {
    if (error?.status == 403) {

        toastr.error(error?.responseJSON?.message)

    } else if (error?.status == 422) {
        $('[id$="-error"]').html('');

        var errors = error.responseJSON.errors;

        if(type_form == "create") {
            $.each(errors, function(key, value) {
                $('#' + key + '-error').html(value[0]);
            });
        } else {
            $.each(errors, function(key, value) {
                $('#' + key + '-edit-error').html(value[0]);
            });
        }


        toastr.error("Bạn cần kiểm tra lại thông tin")
    } else if (error?.status == 500) {

        if(error?.responseJSON?.message) {
            toastr.error(error?.responseJSON?.message)
        } else {
            toastr.error(error?.responseJSON?.error)
        }

    } else {

        toastr.error('unknown error')

    }
}


// delay các funciton, request
function debounce(func, delay) {
    let timeout;

    return function executedFunc(...args) {
        if (timeout) {
            clearTimeout(timeout);
        }

        timeout = setTimeout(() => {
            func(...args);
            timeout = null;
        }, delay);
    };
}

// form create
$('#submit_form_add').on('submit', function (event) {
    event.preventDefault();
    var button_html = $('#btn-submit-add').text();
    $('#btn-submit-add').html(`<div class="spinner-border text-light spin-size-2" role="status">
        <span class="sr-only">Loading...</span>
    </div>`);

    var formData = new FormData(this);
    var url = $('#submit_form_add').attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            datatables.ajax.reload();
            $('#btn-submit-add').html(button_html)
            toastr.success(response?.success)
            $('#ModalAddNew').modal('hide')
            document.getElementById("submit_form_add").reset();
            $('[id$="-error"]').html('');
        },
        error: function (xhr) {
            check_message_error(xhr)
            $('#btn-submit-add').html(button_html)
        }
    });
})


// form edit
$(document).on('click', '.modal-edit', function (event) {
    event.preventDefault();
    var url = $(this).data('url');
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id: $(this).data('id'),
        },
        success: async function (response) {
            if(response) {
                await $("#ModalEditContent").html(response)
                await $('#ModalEdit').modal('show');
            }
        },
        error: function (xhr) {
            $('#ModalEdit').modal('hide');
            $("#ModalEditContent").html("")
        }
    });
})

$(document).on('submit', '#submit_form_edit', function (event) {
    event.preventDefault();

    var button_html = $('#btn-submit-edit').text();
    $('#btn-submit-edit').html(`<div class="spinner-border text-light spin-size-2" role="status">
        <span class="sr-only">Loading...</span>
    </div>`);

    var formData = new FormData(this);
    var url = $('#submit_form_edit').attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            datatables.ajax.reload();
            $('#btn-submit-edit').html(button_html)
            toastr.success(response?.success)
            $('#ModalEdit').modal('hide')
            document.getElementById("submit_form_edit").reset();
        },
        error: function (xhr) {
            check_message_error(xhr, "edit")
            $('#btn-submit-edit').html(button_html)
        }
    });
})


// delete
$(document).on('click', '.detele_item', function() {
    var id = $(this).data('id');
    var url = $(this).data('url');
    // var confirm = $(this).data('confirm');
    // var content_html = $(this).data('content');

    Swal.fire({
        text: "Bạn chắc chắn muốn  xóap",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xác nhận"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    id: id,
                },
                success: function(response) {
                    toastr.success(response?.success)
                    datatables.ajax.reload();
                },
                error: function(xhr, status, error) {
                    check_message_error(xhr)
                    datatables.ajax.reload();
                }
            });
        }
    });

});

