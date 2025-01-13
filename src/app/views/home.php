<h2>Clientes</h2>
<p id="info-return-funcionarios"></p>

<div class="block-btn">
    <a href="/painel/cliente/cadastro" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Cadastrar
    </a>        

</div>
<table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th class="d-none d-sm-table-cell">Email</th>
            <th class="d-none d-md-table-cell">Tipo pessoa</th>
            <th class="d-none d-lg-table-cell">Endereço</th>
            <th class="d-none d-xl-table-cell">Data de Cadastro</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($clientes)) : ?>
            <?php foreach ($clientes as $cliente) : ?>
                <tr style="background-color: <?php echo $cliente['background'] ?? 'transparent'; ?>;">
                    <td><?php echo htmlspecialchars($cliente['id']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo htmlspecialchars($cliente['email']); ?></td>
                    <td class="d-none d-md-table-cell"><?php echo htmlspecialchars($cliente['tipo_pessoa']); ?></td>
                    <td class="d-none d-lg-table-cell"><?php echo htmlspecialchars($cliente['endereco']); ?></td>
                    <td class="d-none d-xl-table-cell"><?php echo htmlspecialchars($cliente['data_cadastro']); ?></td>
                    <td>
                        <a href="/controle_clientes/public/clientes/editar/<?php echo $cliente['id']; ?>" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                    </td>
                    <td>
                        <form style="display:inline-block;">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="excluir(event, '<?php echo $cliente['id'] ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="8" class="text-center">Nenhum cliente encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
