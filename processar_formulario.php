<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"]) && isset($_POST["telefone"]) && isset($_POST["Cargo"]) && isset($_POST["senioridade"])) {
        $nome = htmlspecialchars($_POST["nome"]);
        $telefone = htmlspecialchars($_POST["telefone"]);
        $cargo = htmlspecialchars($_POST["Cargo"]);
        $senioridade = htmlspecialchars($_POST["senioridade"]);
        $salario = htmlspecialchars($_POST["salario"]);

        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'bancodedados';

        $conexao = new mysqli($host, $usuario, $senha, $banco);

        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
        }

        $sql = "INSERT INTO registros_candidatos (Nome, Telefone, Cargo, Senioridade, Salario) VALUES ('$nome', '$telefone', '$cargo', '$senioridade', '$salario')";

        if ($conexao->query($sql) === TRUE) {
            $mensagem = "Registro inserido com sucesso!";
        } else {
            $mensagem = "Erro: " . $sql . "<br>" . $conexao->error;
        }

        $conexao->close();
    } else {
        $mensagem = "Por favor, preencha todos os campos do formulário.";
    }
} else {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Processado</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl text-center mb-4">Cadastro de Pessoas</h1>
        <?php if (isset($mensagem)) : ?>
        <div class="text-center mb-4">
            <p><?php echo $mensagem; ?></p>
        </div>
        <?php endif; ?>
        <div class='flex items-center gap-4 justify-center'>
            <form action="index.php" method="post">
                <div class="text-center">
                    <button type="submit" name="voltar" class="bg-blue-500 text-white p-4 rounded">Voltar e adicionar mais pessoas</button>
                </div>
            </form>
            <form action="visualizar_pessoas.php" method="post">
                <div class="text-center">
                    <button type="submit" name="visualizar" class="bg-blue-500 text-white p-4 rounded">Visualizar Pessoas Cadastradas</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
