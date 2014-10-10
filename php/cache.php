<?php

$cachefile = dirname(__FILE__) . '/cache/' . md5($_SERVER['REQUEST_URI']);
$cachetime = 60 * 60 * 4; // 4 hours

if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
    header("X-Cached: ".date('jS F Y H:i', filemtime($cachefile)));
    include($cachefile);
    exit;
}
ob_start();

// things n stuff

$cachefp = fopen($cachefile, 'w');
fwrite($cachefp, ob_get_contents());
fclose($cachefp);
ob_end_flush();
