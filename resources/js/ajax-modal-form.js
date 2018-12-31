$(document).on('click', 'a.page-link', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});

$(document).on('click', 'button#delete', function (event) {
    event.preventDefault();
    if($('#delete_type').val() == "task")
        ajaxDelete("/delete/"+$('input[name=delete_id]').val(), $('#delete_token').val());
    else if($('#delete_type').val() == "project")
    {
        $.post( "/projects/delete/"+$('input[name=delete_id]').val(), { _method: 'DELETE', _token: $('#delete_token').val() } )
          .done(function( data ) {
            $('#modalForm').modal('hide');
            window.location.href = "/projects";
        });   
    }
        
});

$(document).on('submit', 'form#frm', function (event) {
    event.preventDefault();
    var form = $(this);
    var data = new FormData($(this)[0]);
    var url = form.attr("action");
    $.ajax({
        type: form.attr('method'),
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('.is-invalid').removeClass('is-invalid');
            if (data.fail) {
                for (control in data.errors) {
                    $('input[name=' + control + ']').addClass('is-invalid');
                    $('#error-' + control).html(data.errors[control]);
                }
                if(data.duplicate)
                {
                    $('#modalForm').modal('hide');
                    $('#modalDuplicateError').modal('show');
                }
            } else {
                $('#modalForm').modal('hide');
                ajaxLoad(data.redirect_url);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
    return false;
});

function ajaxLoad(filename, content) {
    content = typeof content !== 'undefined' ? content : 'content';
    $('.loading').show();
    $.ajax({
        type: "GET",
        url: filename,
        contentType: false,
        success: function (data) {
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
function ajaxDelete(filename, token, content) {
    content = typeof content !== 'undefined' ? content : 'content';
    $('.loading').show();
    $.ajax({
        type: 'POST',
        data: {_method: 'DELETE', _token: token},
        url: filename,
        success: function (data) {
            $('#modalDelete').modal('hide');
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
$(document).on('show.bs.modal','#modalForm', function (event) {
    var button = $(event.relatedTarget);
    ajaxLoad(button.data('href'), 'modal_content');
});

$(document).on('show.bs.modal','#modalDelete', function (event) {
    var button = $(event.relatedTarget);
     $('#delete_id').val(button.data('id'));
     $('#delete_token').val(button.data('token'));
     $('#delete_type').val(button.data('type'));
});

$(document).on('show.bs.modal','#modalDeleteError', function (event) {
  var button = $(event.relatedTarget);
});

$(document).on('shown.bs.modal','#modalForm', function () {
    $('#focus').trigger('focus')
});

$(document).on('click', '#toggleStatus', function(event){
    event.preventDefault();
    var completed = (!$(this).data('completed') ? 'true' : 'false');
    var id = $(this).data('id');
    $.ajax({
        url: '/toggleStatus/'+id+'/'+completed,
        type: "GET",
            success: function(data) {
            ajaxLoad(data.redirect_url);
       },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
    }
    })
});

$(document).on('click', '#ajaxRedirect', function(event){
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});


