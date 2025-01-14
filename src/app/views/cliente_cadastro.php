<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3>Cadastro de Clientes</h3>
            </div>
            <div class="card-body">
                <div id="alert-return" class="alert alert-danger d-none" role="alert">

                </div>
                <form id="formCadastroCliente" method="POST">
                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-4 col-lg-2">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" pattern="\d{5}-\d{3}" maxlength="9" required>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" required>
                        </div>
                        <div class="col-12 col-md-2 col-lg-2">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>
                        <div class="col-12 col-md-2 col-lg-2">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="tipoPessoa" class="form-label">Tipo de Pessoa</label>
                            <select class="form-select" id="tipoPessoa" name="tipoPessoa" required>
                                <option value="fisica">Pessoa Física</option>
                                <option value="juridica">Pessoa Jurídica</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-3" id="cpf-content">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" disabled>
                            <p id="alertCpf" class="text-danger d-none">CPF inválido</p>
                        </div>

                        <div class="col-12 col-md-3" id="cnpj-content">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" maxlength="18" disabled>
                            <p id="alertCnpj" class="text-danger d-none">CNPJ inválido</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary" href="/painel/home">Voltar</a>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>