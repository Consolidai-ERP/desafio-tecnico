
$(document).ready(function () {

    $('#tipoPessoa').change(function () {
        const tipoPessoa = $(this).val();
        const cpf_content = $('#cpf-content');
        const cnpj_content = $('#cnpj-content');
        const inputCpf = $('#cpf');
        const inputCnpj = $('#cnpj');

        if (tipoPessoa === 'fisica') {
            cpf_content.show();
            cnpj_content.hide();
            inputCpf.prop('disabled', false);
            inputCnpj.prop('disabled', true);
        } else if (tipoPessoa === 'juridica') {
            cpf_content.hide();
            cnpj_content.show();
            inputCpf.prop('disabled', true);
            inputCnpj.prop('disabled', false);
        }
    });
    $('#tipoPessoa').trigger('change');

    $('#nome').on('input', function () {
        var valor = $(this).val().replace(/[^a-zA-Z\s]/g, '');
        $(this).val(valor);
    });

    $('#cep').on('input', function () {
        var valor = $(this).val().replace(/\D/g, '')
        if (valor.length <= 5) {
            valor = valor.replace(/(\d{5})(\d{1,})/, '$1-$2');
        } else {
            valor = valor.replace(/(\d{5})(\d{3})/, '$1-$2');
        }
        $(this).val(valor);
    });

    $('#cep').on('blur', function () {

        var cep = $(this).val().replace(/\D/g, '');

        if (cep.length === 8) {

            $.ajax({
                url: `https://viacep.com.br/ws/${cep}/json/`,
                method: 'GET',
                success: function (data) {
                    if (data.erro) {
                        alert("CEP não encontrado!");
                    } else {
                        $('#endereco').val(`${data.logradouro} - ${data.bairro}`);
                    }
                },
                error: function () {
                    alert("Erro ao buscar o CEP!");
                }
            });
        } else {
            alert("CEP inválido!");
        }
    });

    /* Mascára de CNPJ */
    $('#cnpj').on('input', function () {
        var input = $(this).val();
        if (input.replace(/\D/g, '').length <= 14) {
            $(this).val(input.replace(/\D/g, '')
                .replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5')
            );
        }
    });

    /* Mascára de CPF */
    $('#cpf').on('input', function () {
        var input = $(this).val();
        if (input.replace(/\D/g, '').length <= 11) {
            $(this).val(input.replace(/\D/g, '')
                .replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4')
            );
        }
    });

    const formCadastroCliente = $('#formCadastroCliente');
    if (formCadastroCliente.length) {
        formCadastroCliente.on('submit', function (event) {
            event.preventDefault();
            cadastroCliente();
        });
    }
});

// Valida CPF
function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11) return false;

    var soma = 0;
    var resto;

    for (var i = 1; i <= 9; i++) {
        soma += parseInt(cpf[i - 1]) * (11 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf[9])) return false;

    soma = 0;
    for (var i = 1; i <= 10; i++) {
        soma += parseInt(cpf[i - 1]) * (12 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf[10])) return false;

    return true;
}

/* Valida CNPJ */
function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/\D/g, '');

    if (cnpj.length !== 14) return false;

    var tamanho = cnpj.length - 2;
    var numeros = cnpj.substring(0, tamanho);
    var digitos = cnpj.substring(tamanho);
    var soma = 0;
    var pos = tamanho - 7;
    for (var i = tamanho; i >= 1; i--) {
        soma += parseInt(cnpj.charAt(tamanho - i)) * pos--;
        if (pos < 2) pos = 9;
    }

    var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado !== parseInt(digitos.charAt(0))) return false;

    soma = 0;
    pos = tamanho - 7;
    for (var i = tamanho + 1; i >= 1; i--) {
        soma += parseInt(cnpj.charAt(tamanho - i)) * pos--;
        if (pos < 2) pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado !== parseInt(digitos.charAt(1))) return false;

    return true;
}

function showLoading() {
    $('#loading-overlay').css('display', 'flex');
}

function hideLoading() {
    $('#loading-overlay').css('display', 'none');
}

function alertMsg(el, success, msg) {
    el.text(msg);
    if (success) {
        el.removeClass('alert-danger').addClass('alert-success');
    } else {
        el.removeClass('alert-success').addClass('alert-danger');
    }
    el.text(msg).removeClass('d-none').css('display', 'block');
    return;
}

function cadastroCliente() {

    const csrf_token = $('#csrf_token').val();

    let nome = $('#nome').val();
    let email = $('#email').val();
    let endereco = $('#endereco').val();
    let numero = $('#numero').val();
    let complemento = $('#complemento').val();
    let cep = $('#cep').val();

    const tipoPessoa = $('#tipoPessoa').val();

    if (tipoPessoa === 'fisica') {
        var cpfcnpj = $('#cpf').val();
    } else if (tipoPessoa === 'juridica') {
        var cpfcnpj = $('#cnpj').val();
    }

    const infoReturn = $('#alert-return');

    showLoading();
    $.ajax({
        url: '/painel/cliente/insert',
        type: 'POST',
        async: true,
        method: 'POST',
        dataType: 'json',
        data: {
            csrf_token: csrf_token,
            nome: nome,
            email: email,
            endereco: endereco,
            cep: cep,
            numero: numero,
            complemento: complemento,
            tipo_pessoa: tipoPessoa,
            cpf_cnpj: cpfcnpj,
        },
        success: function (response) {
            if (response.success) {
                alertMsg(infoReturn, true, response.message);
                hideLoading();
            } else {
                alertMsg(infoReturn, false, response.message);
                hideLoading();
            }
        }, error: function () {
            alertMsg(infoReturn, false, "Houve um erro inesperado! Por favor tente novamente.");
            hideLoading();
        }
    });
}
