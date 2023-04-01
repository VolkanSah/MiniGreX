<?PHP

// Location and prefix for cache files
define('CACHE_PATH', "cache/");
define('CACHE_PATH_POST', CACHE_PATH . "posts");
define('CACHE_PATH_PAGE', CACHE_PATH . "pages");
define('CACHE_PATH_UPLOAD', CACHE_PATH . "uploads");

// How long to keep the cache files (hours)
define('CACHE_TIME', 24);

// Return location and name for cached post
function cache_file_post($id)
{
    return CACHE_PATH_POST . "/" . $id . ".html";
}

// Return location and name for cached page
function cache_file_page($slug)
{
    return CACHE_PATH_PAGE . "/" . $slug . ".html";
}

// Return location and name for cached upload
function cache_file_upload($file_path)
{
    return CACHE_PATH_UPLOAD . "/" . md5($file_path) . ".html";
}

// If present and not expired show cached files
function cache_display()
{
    $uri = $_SERVER['REQUEST_URI'];
    $file = '';

    // Check if URI is for a post or page
    if (strpos($uri, '/post/') !== false) {
        // URI is for a post
        $post_id = explode('/', $uri)[2];
        $file = cache_file_post($post_id);
    } elseif (strpos($uri, '/page/') !== false) {
        // URI is for a page
        $slug = explode('/', $uri)[2];
        $file = cache_file_page($slug);
    } elseif (strpos($uri, '/uploads/') !== false) {
        // URI is for an upload
        $file_path = explode('/', $uri)[2];
        $file = cache_file_upload($file_path);
    }

    // Check if file exists and timestamp
    if (!file_exists($file)) {
        return;
    }
    if (filemtime($file) < time() - CACHE_TIME * 3600) {
        return;
    }

    // Display cache file and stop processing
    echo file_get_contents($file);
    exit;
}

// Write cache files
function cache_page($content)
{
    $uri = $_SERVER['REQUEST_URI'];
    $file = '';

    // Check if URI is for a post or page
    if (strpos($uri, '/post/') !== false) {
        // URI is for a post
        $post_id = explode('/', $uri)[2];
        $file = cache_file_post($post_id);
    } elseif (strpos($uri, '/page/') !== false) {
        // URI is for a page
        $slug = explode('/', $uri)[2];
        $file = cache_file_page($slug);
    } elseif (strpos($uri, '/uploads/') !== false) {
        // URI is for an upload
        $file_path = explode('/', $uri)[2];
        $file = cache_file_upload($file_path);
    }

    // Write content to cache file
    if (false !== ($f = @fopen($file, 'w'))) {
        fwrite($f, $content);
        fclose($f);
    }
    return $content;
}

// Execution stops here if valid cache file found
cache_display();

// Enable output buffering and create cache file
ob_start('cache_page');
