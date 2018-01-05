<?php
$array = array();

function getToken($link) {

  global $array;

  $files = file_get_contents($link);
  $regex = '/<a href="(.+)">/';
  preg_match_all($regex, $files, $matches);
  $urls = $matches[1];

  foreach($urls as $url) {
    if ($url == "../")
      continue ;
    if ($url == "README") {
      $c = file_get_contents($link.$url);
      $c = trim($c);
      if ( !in_array($c, $array) ) {
        print_r($link.$url." => ".$c."\n");
        $array[$c] = $c;
      }
    } else {
      getToken($link . $url);
    }
  }
}
getToken("http://10.12.1.117/.hidden/");
?>
