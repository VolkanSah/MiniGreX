<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    cache/cache_db.php.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 *  Class cache_db
 * 
 * 
 */

class Cache {
    private $cacheDir;

    public function __construct($cacheDir = 'cache') {
        $this->cacheDir = $cacheDir;

        // Verzeichnis erstellen, falls es nicht existiert
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function set($key, $data, $ttl = 3600) {
        $filePath = $this->getFilePath($key);
        $expiry = time() + $ttl;
        $cacheData = ['expiry' => $expiry, 'data' => $data];
        file_put_contents($filePath, serialize($cacheData));
    }

    public function get($key) {
        $filePath = $this->getFilePath($key);

        if (file_exists($filePath)) {
            $cacheData = unserialize(file_get_contents($filePath));

            if ($cacheData['expiry'] > time()) {
                return $cacheData['data'];
            } else {
                // Cache abgelaufen
                unlink($filePath);
            }
        }

        return false;
    }

    private function getFilePath($key) {
        return $this->cacheDir . '/' . md5($key) . '.cache';
    }
}

?>
