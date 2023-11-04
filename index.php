<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bancodedados';


$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"]) && isset($_POST["telefone"]) && isset($_POST["Cargo"]) && isset($_POST["senioridade"])) {
        $nome = htmlspecialchars($_POST["nome"]);
        $telefone = htmlspecialchars($_POST["telefone"]);
        $cargo = htmlspecialchars($_POST["Cargo"]);
        $senioridade = htmlspecialchars($_POST["senioridade"]);

        $sql = "INSERT INTO registros_candidatos (Nome, Telefone, Cargo, Senioridade) VALUES ('$nome', '$telefone', '$cargo', '$senioridade')";

        if ($conexao->query($sql) === TRUE) {
            echo "Registro inserido com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . $conexao->error;
        }
    }
}

$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 h-screen flex flex-col items-center justify-center">
    
    <div class="bg-white p-6 gap-4 flex flex-col rounded-lg shadow-md">
        <h1 class="text-2xl text-center mb-4">Cadastro de Pessoas</h1>
        <form method="post" action="processar_formulario.php">
            <div class="mb-4">
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" id="nome" name="nome" class="border-2 form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="tel" id="telefone" name="telefone" class="border-2  form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
            <div class="mb-4">
            <label for="cargo" class="block text-sm font-medium text-gray-700">Cargo:</label>
                <input type="text" id="Cargo" name="Cargo" class="border-2  form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
            <label for="salario" class="block text-sm font-medium text-gray-700">Salaro:</label>
            <input type="text" id="salario" name="salario" class="border-2  form-input rounded-md shadow-sm mt-1 block w-full" required>
            <div class='flex gap-4'>
                <label for="senioridade" class="block text-sm font-medium text-gray-700">Senioridade:</label>
                <select name="senioridade" required>
                    <option value="Júnior">Júnior</option>
                    <option value="Pleno">Pleno</option>
                    <option value="Sênior">Sênior</option>
                </select>
            </div>
                <button type="submit" class="bg-blue-500 mt-4 w-full text-white px-4 py-2 rounded hover:cursor-pointer hover:scale-110">Enviar</button>
        </form>
        <form action="visualizar_pessoas.php" method="post">
                <div class="text-center ">
                    <button type="submit" name="visualizar" class="bg-blue-500 text-white p-4 rounded">Visualizar Pessoas Cadastradas</button>
                </div>
            </form>
    </div>
</body>
</html>
