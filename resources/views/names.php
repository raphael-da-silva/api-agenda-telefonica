<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Teste API Telefonica - Raphael da Silva</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        .container{
            max-width: 900px;
        }
    </style>    
</head>

<body class="bg-dark">
    <div class="container bg-white p-2 text-center mt-2">
        <h3 class="fw-bold text-info">
            Nomes da agenda <span class="text-dark">(<?php echo count($list); ?>)</span>
        </h3>

        <hr>

        <?php if(count($list) > 0){ ?>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-info">Nome</th>
                        <th>E-mail</th>
                        <th>Data de nascimento</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($list as $item){ ?>
                        <tr>
                            <td class="text-info"><?php echo $item->name; ?></td>
                            <td><?php echo $item->email; ?></td>
                            <td><?php echo \DateTime::createFromFormat('Y-m-d', $item->birth)->format('d/m/Y'); ?></td>
                            <td><?php echo $item->cpf; ?></td>
                            <td><?php echo $item->phone; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php }else{ ?>
            <div class="alert alert-danger">
                Nenhum registro encontrado.
            </div>
        <?php } ?>
    </div>
</body>
</html>
