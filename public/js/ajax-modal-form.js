/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, exports) {

$(document).on('click', 'a.page-link', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});

$(document).on('click', 'button#delete', function (event) {
    event.preventDefault();
    if ($('#delete_type').val() == "task") ajaxDelete("/delete/" + $('input[name=delete_id]').val(), $('#delete_token').val());else if ($('#delete_type').val() == "project") {
        $.post("/projects/delete/" + $('input[name=delete_id]').val(), { _method: 'DELETE', _token: $('#delete_token').val() }).done(function (data) {
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
        success: function success(data) {
            $('.is-invalid').removeClass('is-invalid');
            if (data.fail) {
                for (control in data.errors) {
                    $('input[name=' + control + ']').addClass('is-invalid');
                    $('#error-' + control).html(data.errors[control]);
                }
                if (data.duplicate) {
                    $('#modalForm').modal('hide');
                    $('#modalDuplicateError').modal('show');
                }
            } else {
                $('#modalForm').modal('hide');
                ajaxLoad(data.redirect_url);
            }
        },
        error: function error(xhr, textStatus, errorThrown) {
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
        success: function success(data) {
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function error(xhr, status, _error) {
            alert(xhr.responseText);
        }
    });
}
function ajaxDelete(filename, token, content) {
    content = typeof content !== 'undefined' ? content : 'content';
    $('.loading').show();
    $.ajax({
        type: 'POST',
        data: { _method: 'DELETE', _token: token },
        url: filename,
        success: function success(data) {
            $('#modalDelete').modal('hide');
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function error(xhr, status, _error2) {
            alert(xhr.responseText);
        }
    });
}
$(document).on('show.bs.modal', '#modalForm', function (event) {
    var button = $(event.relatedTarget);
    ajaxLoad(button.data('href'), 'modal_content');
});

$(document).on('show.bs.modal', '#modalDelete', function (event) {
    var button = $(event.relatedTarget);
    $('#delete_id').val(button.data('id'));
    $('#delete_token').val(button.data('token'));
    $('#delete_type').val(button.data('type'));
});

$(document).on('show.bs.modal', '#modalDeleteError', function (event) {
    var button = $(event.relatedTarget);
});

$(document).on('shown.bs.modal', '#modalForm', function () {
    $('#focus').trigger('focus');
});

$(document).on('click', '#toggleStatus', function (event) {
    event.preventDefault();
    var completed = !$(this).data('completed') ? 'true' : 'false';
    var id = $(this).data('id');
    $.ajax({
        url: '/toggleStatus/' + id + '/' + completed,
        type: "GET",
        success: function success(data) {
            ajaxLoad(data.redirect_url);
        },
        error: function error(xhr, status, _error3) {
            alert(xhr.responseText);
        }
    });
});

$(document).on('click', '#ajaxRedirect', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});

/***/ })

/******/ });