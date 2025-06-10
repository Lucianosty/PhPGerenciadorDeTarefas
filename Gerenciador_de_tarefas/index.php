<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tarefas</title>
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
            text-align: center;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
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
        .tarefa {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .concluida {
            border-left: 5px solid #2ecc71;
        }
        .pendente {
            border-left: 5px solid #f39c12;
        }
        .atrasada {
            border-left: 5px solid #e74c3c;
        }
        .acoes {
            margin-top: 10px;
        }
        .acoes a {
            margin-right: 10px;
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>
<body>
    <h1>Gestor de Tarefas</h1>
    
    <!-- Formulário para adicionar nova tarefa -->
    <form method="post" action="index.php">
        <h2>Nova Tarefa</h2>
        <input type="hidden" name="acao" value="criar">
        
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
        
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
        
        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required>
        
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Pendente">Pendente</option>
            <option value="Concluída">Concluída</option>
            <option value="Atrasada">Atrasada</option>
        </select>
        
        <button type="submit">Salvar Tarefa</button>
    </form>
    
      <h2>Suas Tarefas</h2>
    <?php
        include 'funcoes.php';
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $acao = $_POST['acao'] ?? '';
            
            if ($acao === 'criar') {
                criarTarefa($_POST);
            } elseif ($acao === 'atualizar') {
                atualizarTarefa($_POST);
            } elseif ($acao === 'excluir') {
                excluirTarefa($_POST['id']);
            }
        }
        
       
        exibirTarefas();
    ?>


</body>
</html>