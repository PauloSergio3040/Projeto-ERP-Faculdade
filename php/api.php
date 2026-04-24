<?php
/*Define que a resposta da api será em formato json.*/
header("Content-Type: application/json; charset=UTF-8");
/*Libera o acesso da api para qualquer origem.*/
header("Access-Control-Allow-Origin: *");
/*Define quais métodos http são permitidos na api. (GET, POST, PUT, DELETE)*/
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
/*Permite que o frontend envie o header content-tyoe. Necessário para enviar dados em formato json via requisição.*/
header("Access-Control-Allow-Headers: Content-Type");
/*Pega o valor da entidade pela url. Se não for informado ele vai definir como vazio para evitar erro.*/
$entidade = $_GET['entidade'] ?? '';
/*Identifica qual método http*/
$metodo = $_SERVER['REQUEST_METHOD'];
/*Define o caminho da pasta onde ficam os arquivos json. Usa o diretório atual como base.*/
$baseDir = __DIR__ . '/../data/';

$arquivos = [
    'produtos' => $baseDir . 'produtos.json',
    'clientes' => $baseDir . 'clientes.json'
];
/*Verifica se a entidade informada existe no sistema -> Se não existir -> retorna erro e interrompe a execução.*/
if (!isset($arquivos[$entidade])) {
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Entidade inválida."
    ]);
    exit;
}
/*Define qual arquivo json será usado com base na entidade escolhida.*/
$arquivo = $arquivos[$entidade];
/*Verifica se o arquivo existe -> Se não existir -> cria um arquivo json vazio*/
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
/*Lê o conteúdo do arquivo json e depois converte para array php*/
function lerDados($arquivo) {
    $conteudo = file_get_contents($arquivo);
    $dados = json_decode($conteudo, true);

    if (!is_array($dados)) {
        $dados = [];
    }

    return $dados;
}
/*Salva os dados no arquivo json, depois ele converte o array php para json antes de salvar*/
function salvarDados($arquivo, $dados) {
    file_put_contents(
        $arquivo,
        json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}
/*Recebe dados enviados pelo front no formato json, depois ele converte para array php. se tiver vazio ele retorna um array vazio*/
function receberJson() {
    $json = file_get_contents("php://input");
    $dados = json_decode($json, true);

    if (!is_array($dados)) {
        $dados = [];
    }

    return $dados;
}
/*Crud apenas*/
switch ($metodo) {
    case 'GET':
        $dados = lerDados($arquivo);
        echo json_encode($dados);
        break;

    case 'POST':
        $dados = lerDados($arquivo);
        $novo = receberJson();

        $maiorId = 0;
        foreach ($dados as $item) {
            if ($item['id'] > $maiorId) {
                $maiorId = $item['id'];
            }
        }

        $novo['id'] = $maiorId + 1;
        $dados[] = $novo;

        salvarDados($arquivo, $dados);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Registro cadastrado com sucesso.",
            "dados" => $novo
        ]);
        break;

    case 'PUT':
        $dados = lerDados($arquivo);
        $atualizado = receberJson();

        if (!isset($atualizado['id'])) {
            echo json_encode([
                "sucesso" => false,
                "mensagem" => "ID não informado."
            ]);
            exit;
        }

        $encontrado = false;

        foreach ($dados as $indice => $item) {
            if ($item['id'] == $atualizado['id']) {
                $dados[$indice] = $atualizado;
                $encontrado = true;
                break;
            }
        }

        if ($encontrado) {
            salvarDados($arquivo, $dados);
            echo json_encode([
                "sucesso" => true,
                "mensagem" => "Registro atualizado com sucesso."
            ]);
        } else {
            echo json_encode([
                "sucesso" => false,
                "mensagem" => "Registro não encontrado."
            ]);
        }
        break;

    case 'DELETE':
        $dados = lerDados($arquivo);
        $corpo = receberJson();

        if (!isset($corpo['id'])) {
            echo json_encode([
                "sucesso" => false,
                "mensagem" => "ID não informado."
            ]);
            exit;
        }

        $id = $corpo['id'];
        $dadosFiltrados = [];

        foreach ($dados as $item) {
            if ($item['id'] != $id) {
                $dadosFiltrados[] = $item;
            }
        }

        salvarDados($arquivo, $dadosFiltrados);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Registro excluído com sucesso."
        ]);
        break;

    default:
        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Método não permitido."
        ]);
        break;
}
/*Essa switch implementa crud usando json como bd, cada método controla uma ação no sistema*/
?>
