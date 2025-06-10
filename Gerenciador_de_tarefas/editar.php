<!--Página especifica para edição de tarefas--> 
<?php
include 'funcoes.php';

$id = $_GET['id'] ?? '';
$tarefas = lerTarefas();
$tarefaEditar = null;

foreach ($tarefas as $tarefa) {
    if ($tarefa['id'] === $id) {
        $tarefaEditar = $tarefa;
        break;
    }
}

if (!$tarefaEditar) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        h1 {
            color: #2c3e50;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .acoes {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Editar Tarefa</h1>
    
    <form method="post" action="index.php">
        <input type="hidden" name="acao" value="atualizar">
        <input type="hidden" name="id" value="<?= $tarefaEditar['id'] ?>">
        
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($tarefaEditar['titulo']) ?>" required>
        
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?= htmlspecialchars($tarefaEditar['descricao']) ?></textarea>
        
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" value="<?= $tarefaEditar['data'] ?>" required>
        
        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" value="<?= $tarefaEditar['hora'] ?>" required>
        
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Pendente" <?= $tarefaEditar['status'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="Concluída" <?= $tarefaEditar['status'] === 'Concluída' ? 'selected' : '' ?>>Concluída</option>
            <option value="Atrasada" <?= $tarefaEditar['status'] === 'Atrasada' ? 'selected' : '' ?>>Atrasada</option>
        </select>
        
        <div class="acoes">
            <button type="submit">Atualizar Tarefa</button>
            <a href="index.php">Cancelar</a>
        </div>
    </form>
</body>
</html>