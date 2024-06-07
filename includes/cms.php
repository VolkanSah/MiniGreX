<?php

class CMS {
    private $pdo;
    private $cache;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->cache = new Cache();
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

    // Cache-Funktionen
    public function cacheSet($key, $data, $ttl = 3600) {
        $this->cache->set($key, $data, $ttl);
    }

    public function cacheGet($key) {
        return $this->cache->get($key);
    }

    // Weitere CMS-Funktionen hier hinzufügen
}

?>
