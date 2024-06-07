<?php
class CMS {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function run() {
        // Beispiel: Startseite laden
        $this->loadPage('home');
    }

    private function loadPage($page) {
        // Beispiel: Seite laden
        $pagePath = __DIR__ . '/../themes/default/public/' . $page . '.php';
        if (file_exists($pagePath)) {
            require_once $pagePath;
        } else {
            die('Seite nicht gefunden.');
        }
    }

    // Weitere CMS-Funktionen hier hinzufügen
}
?>
