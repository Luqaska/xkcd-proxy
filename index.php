<?php $endpoint = "https://xkcd-proxy.lu700.repl.co";
$home = '<!DOCTYPE html><html dir="ltr" lang="en"><head><title>xkcd-proxy</title><style>.m{background:lightgreen;}.n{background:lightblue;}</style></head><body><h1>xkcd-proxy</h1><p>A simple proxy for accessing the <a href="https://xkcd.com/json.html">XKCD\'s json API</a></p><ul><li>Endpoint: <code>'.$endpoint.'</code></li><br><li><span class="m">[GET]</span> <code class="n">/?last</code> <i>Get data from the last comic</i></li><li><span class="m">[GET]</span> <code class="n">/?n={number}</code> <i>Get data from a specific comic</i></li></ul><p><a href="https://github.com/luqaska/xkcd-proxy">Source code</a> - Made by <a href="https://lucas.koyu.space">Luqaska</a></p></body></html>';
if(isset($_GET["last"])){
  shell_exec("curl -o tmp/info.json https://xkcd.com/info.0.json");
  $dld = file_get_contents("tmp/info.json");
  if(isset($_GET["img"])){
    $api = json_decode($dld);
    shell_exec("curl -o tmp/comic ".$api->{"img"});
    header("Content-Type: ".mime_content_type("tmp/comic"));
    die(file_get_contents("tmp/comic"));
  }elseif(isset($_GET["title"])){
    $api = json_decode($dld);
    header("Content-Type: text/plain");
    die($api->{"title"});
  }elseif(isset($_GET["safe_title"])){
    $api = json_decode($dld);
    header("Content-Type: text/plain");
    die($api->{"safe_title"});
  }else{
    header("Content-Type: application/json");
    die(file_get_contents("tmp/info.json"));
  }
}elseif(isset($_GET["n"])){
  if(is_numeric($_GET["n"])){
    shell_exec("curl -o tmp/info.json https://xkcd.com/".$_GET["n"]."/info.0.json");
    $dld = file_get_contents("tmp/info.json");
    if(file_get_contents("404.htm") == $dld){
      die('{"success":false}');
    }else{
      if(isset($_GET["img"])){
        $api = json_decode($dld);
        shell_exec("curl -o tmp/comic ".$api->{"img"});
        header("Content-Type: ".mime_content_type("tmp/comic"));
        die(file_get_contents("tmp/comic"));
        }elseif(isset($_GET["title"])){
          $api = json_decode($dld);
          header("Content-Type: text/plain");
          die($api->{"title"});
        }elseif(isset($_GET["safe_title"])){
          $api = json_decode($dld);
          header("Content-Type: text/plain");
          die($api->{"safe_title"});
      }else{
        header("Content-Type: application/json");
        die(file_get_contents("tmp/info.json"));
      }
    }
  }else{die($home);}
}else{die($home);} ?>
