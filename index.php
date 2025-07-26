<?php
// index.php — Mini Micro-MVC em um só arquivo

// ----------------------
// 1. MODEL
// ----------------------
class Model {
    public static function getData(): array {
        return [
            'title'   => 'Bem-vindo ao Micro-MVC Educativo',
            'message' => 'Este exemplo demonstra MVC em um único arquivo PHP.'
        ];
    }
}

// ----------------------
// 2. VIEW
// ----------------------
function render(array $data): void {
    extract($data);  // Converte chaves em variáveis :contentReference[oaicite:5]{index=5}
    echo "<!DOCTYPE html><html lang='pt-br'><head><meta charset='UTF-8'>";
    echo "<title>$title</title></head><body>";
    echo "<h1>$title</h1><p>$message</p><hr>";
    echo "<p><a href='?action=home'>Início</a> | <a href='?action=info'>Info</a></p>";
    echo "</body></html>";
}

// ----------------------
// 3. CONTROLLER
// ----------------------
class Controller {
    public function home(): void {
        $data = Model::getData();
        render($data);
    }
    public function info(): void {
        $data = [
            'title'   => 'Página de Informação',
            'message' => 'Demonstração de outra rota em MVC.'
        ];
        render($data);
    }
}

// ----------------------
// 4. ROUTING SIMPLES
// ----------------------
$action = $_GET['action'] ?? 'home';
$controller = new Controller();

if (method_exists($controller, $action)) {
    $controller->{$action}();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Página não encontrada.";
}
