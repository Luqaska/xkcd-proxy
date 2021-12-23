<?php $endpoint = "https://xkcd-proxy.lu700.repl.co";
$home = '<!DOCTYPE html><html dir="ltr" lang="en"><head><title>xkcd-proxy</title><style>.m{background:lightgreen;}.n{background:lightblue;}</style></head><body><h1>xkcd-proxy</h1><p>A simple proxy for accessing the <a href="https://xkcd.com/json.html">XKCD\'s json API</a></p><ul><li>Endpoint: <code>'.$endpoint.'</code></li><br><li><span class="m">[GET]</span> <code class="n">/?last</code> <i>Get data from the last comic</i></li><li><span class="m">[GET]</span> <code class="n">/?n={number}</code> <i>Get data from a specific comic</i></li></ul><p><a href="https://github.com/luqaska/xkcd-proxy">Source code</a> - Made by <a href="https://lucas.koyu.space">Luqaska</a></p></body></html>';
if(isset($_GET["last"])){
  header("Content-Type: application/json");
  shell_exec("curl -O https://xkcd.com/info.0.json");
  $dld = file_get_contents("info.0.json");
  die(file_get_contents("info.0.json"));
}elseif(isset($_GET["n"])){
  if(is_numeric($_GET["n"])){
    header("Content-Type: application/json");
    shell_exec("curl -O https://xkcd.com/".$_GET["n"]."/info.0.json");
    $dld = file_get_contents("info.0.json");
    if(file_get_contents("404.htm") == $dld){
      die('{"success":false}');
    }else{
      die(file_get_contents("info.0.json"));
    }
  }else{die($home);}
}else{die($home);} ?>
