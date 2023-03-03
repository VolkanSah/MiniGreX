<?PHP

// location and prefix for cache files
define('CACHE_PATH_HTML', "/html");
define('CACHE_PATH_CSS', "/css");
define('CACHE_PATH_JS', "/js");
// how long to keep the cache files (hours)
define('CACHE_TIME', 24);
// return location and name for cached files
  function cache_file()
  {
    return CACHE_PATH . md5($_SERVER['REQUEST_URI']);
  }

  //  if present and not expired show cached files
  function cache_display()
  {
    $file = cache_file();

    // check if file exists & timestamp
    if(!file_exists($file)) return;
    if(filemtime($file) < time() - CACHE_TIME * 3600) return;

    // if display cache file and stop processing
    echo gzuncompress(file_get_contents($file));
    exit;
  }

  // write cache files
  function cache_page($content)
  {
    if(false !== ($f = @fopen(cache_file(), 'w'))) {
      fwrite($f, gzcompress($content));	
      fclose($f);
    }
    return $content;
  }

  // execution stops here if valid cache file found
  cache_display();

  // enable output buffering and create cache file
  ob_start('cache_page');

