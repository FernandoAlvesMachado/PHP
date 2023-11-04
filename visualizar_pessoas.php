<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bancodedados'; 

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

$sql = "SELECT * FROM registros_candidatos";

$resultado = $conexao->query($sql);


$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pessoas Cadastradas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body >
    <div class='w-full'>
        <div class='flex items-center justify-center top-5 right-2/4 left-2/4 fixed gap-8'>
            <form action="index.php" method="post">
            <div class="text-center">
                <button type="submit" name="adicionar" class="bg-blue-500 text-white px-4 py-2 rounded">Adicionar</button>
            </div>
        </form>
        </div>
    </div>
    <div class="bg-gray-200 h-screen flex items-center justify-center">
 
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl text-center mb-4">Pessoas Cadastradas</h1>
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="text-left">Nome</th>
                    <th class="text-left">Telefone</th>
                    <th class="text-left">Cargo</th>
                    <th class="text-left">Senioridade</th>
                    <th class="text-left">Salário</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conexao = new mysqli($host, $usuario, $senha, $banco);

                if ($conexao->connect_error) {
                    die("Erro de conexão: " . $conexao->connect_error);
                }

                $sql = "SELECT * FROM registros_candidatos";

                $resultado = $conexao->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td class='border px-4 py-2'>" . $linha["Nome"] . "</td>
                                <td class='border px-4 py-2'>" . $linha["Telefone"] . "</td>
                                <td class='border px-4 py-2'>" . $linha["Cargo"] . "</td>
                                <td class='border px-4 py-2'>" . $linha["Senioridade"] . "</td>
                                <td class='border px-4 py-2'>" . $linha["Salario"] . "</td>
                            </tr>";
                    }
                } else {
                    echo "Nenhum registro encontrado na tabela.";
                }

                $conexao->close();
                ?>
            </tbody>
        </table>
      
    </div>
    </div>
</body>
</html>
