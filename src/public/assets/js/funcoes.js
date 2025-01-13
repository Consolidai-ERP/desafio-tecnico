$(document).ready(function () {

    /* motrar/ocultar senha */
    $('#show-password').on('click', function () {
        const inputPassword = $('#password');
        const icon = $(this);

        if (inputPassword.attr('type') === 'password') {
            inputPassword.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            inputPassword.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    /* Validação de senha */
    const formLogin = $('#formLogin');
    if (formLogin.length) {
        formLogin.on('submit', function (event) {
            event.preventDefault();
            login();
        });
    }

});


function showLoading() {
    $('#loading-overlay').css('display', 'flex');
}

function hideLoading() {
    $('#loading-overlay').css('display', 'none');
}

function alertMsg(element, success, msg) {
    element.text(msg);
    console.log("1")
    if (success) {
        console.log("2")

        element.removeClass('alert-danger').addClass('alert-success');
    } else {
        console.log("4")

        element.removeClass('alert-success').addClass('alert-danger');
    }
    element.text(msg).removeClass('d-none').css('display', 'block');
    console.log(element);
    return;
}

function login() {
    let email = $('#email').val();
    let password = $('#password').val();

    const eAlertMsg = $('#alertLogin');

    showLoading();
    $.ajax({
        url: '/painel/login/auth',
        type: 'POST',
        async: true,
        method: 'POST',
        dataType: 'json',
        data: {
            email: email,
            password: password
        },

        success: function (response) {

            if (response.success) {
                alertMsg(eAlertMsg, true, response.message);
                hideLoading();
            } else {
                alertMsg(eAlertMsg, false, response.message);
                hideLoading();
            }
        }, error: function (err) {
            console.log(err)
            alertMsg(eAlertMsg, false, "Houve um erro inesperado! Por favor tente novamente.");
            hideLoading();
        }
    });
}