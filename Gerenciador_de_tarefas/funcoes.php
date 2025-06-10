<?php
// Arquivo onde as tarefas serão salvas
define('ARQUIVO_TAREFAS', 'tarefas.json');


if (!file_exists(ARQUIVO_TAREFAS)) {
    file_put_contents(ARQUIVO_TAREFAS, '[]');
}


function lerTarefas() {
    $dados = file_get_contents(ARQUIVO_TAREFAS);
    return json_decode($dados, true);
}

function salvarTarefas($tarefas) {
    file_put_contents(ARQUIVO_TAREFAS, json_encode($tarefas, JSON_PRETTY_PRINT));
}


function criarTarefa($dados) {
    $tarefas = lerTarefas();
    
    $novaTarefa = [
        'id' => uniqid(),
        'titulo' => $dados['titulo'],
        'descricao' => $dados['descricao'],
        'data' => $dados['data'],
        'hora' => $dados['hora'],
        'status' => $dados['status'],
        'data_criacao' => date('Y-m-d H:i:s')
    ];
    
    $tarefas[] = $novaTarefa;
    salvarTarefas($tarefas);
}


function exibirTarefas() {
    $tarefas = lerTarefas();
    
    
    usort($tarefas, function($a, $b) {
        $dataHoraA = $a['data'] . ' ' . $a['hora'];
        $dataHoraB = $b['data'] . ' ' . $b['hora'];
        return strtotime($dataHoraA) - strtotime($dataHoraB);
    });
    
    foreach ($tarefas as $tarefa) {
        $classeStatus = strtolower(str_replace('í', 'i', $tarefa['status'])); // Remove acento para classe CSS
        echo "<div class='tarefa $classeStatus'>";
        echo "<h3>" . htmlspecialchars($tarefa['titulo']) . "</h3>";
        echo "<p><strong>Descrição:</strong> " . htmlspecialchars($tarefa['descricao']) . "</p>";
        echo "<p><strong>Data:</strong> " . htmlspecialchars($tarefa['data']) . "</p>";
        echo "<p><strong>Hora:</strong> " . htmlspecialchars($tarefa['hora']) . "</p>";
        echo "<p><strong>Status:</strong> " . htmlspecialchars($tarefa['status']) . "</p>";
        
       
        echo "<div class='acoes'>";
        echo "<form method='post' action='index.php' style='display:inline;'>";
        echo "<input type='hidden' name='acao' value='excluir'>";
        echo "<input type='hidden' name='id' value='" . $tarefa['id'] . "'>";
        echo "<button type='submit'>Excluir</button>";
        echo "</form>";
        
        echo "<a href='editar.php?id=" . $tarefa['id'] . "'>Editar</a>";
        echo "</div>";
        
        echo "</div>";
    }
}


function atualizarTarefa($dados) {
    $tarefas = lerTarefas();
    
    foreach ($tarefas as &$tarefa) {
        if ($tarefa['id'] === $dados['id']) {
            $tarefa['titulo'] = $dados['titulo'];
            $tarefa['descricao'] = $dados['descricao'];
            $tarefa['data'] = $dados['data'];
            $tarefa['hora'] = $dados['hora'];
            $tarefa['status'] = $dados['status'];
            break;
        }
    }
    
    salvarTarefas($tarefas);
    header('Location: index.php');
    exit();
}


function excluirTarefa($id) {
    $tarefas = lerTarefas();
    
    $tarefas = array_filter($tarefas, function($tarefa) use ($id) {
        return $tarefa['id'] !== $id;
    });
    
    salvarTarefas(array_values($tarefas));
    header('Location: index.php');
    exit();
}