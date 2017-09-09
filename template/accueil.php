<?php

function loadFile($link){
  $src = $link;
  if(file_exists($src)){

    $myFile = fopen($src . "/project.txt", "r");

    $line = array();
      while ($i = fgets($myFile)) {
        if($i != "\n"){
          array_push($line, $i);
                // $line = $line + $i;
      }else{
          // echo "debug delete whitespace";
      }

    }
    fclose($myfile);
  } else {
    $line = -1;
  }

  return $line;
}

function findInLine($string,$src){
  return key(preg_grep("/($string)/", $src));
}

$dir = "content/";
$a = scandir($dir);


$sub = $dir . $a[3];
$b = scandir($sub);
$index = 0;


echo "<div class=\"accueilTitleProject\">";
for ($i=4; $i < sizeof($b); $i++) {
  echo "<h1 class=\"$b[$i]\">" . str_replace("-"," ",$b[$i]) . "</h1> ";
}
echo " </div>";
echo "<div class=\"accueilLegendProject\">";
for ($i=4; $i < sizeof($b); $i++) {
  $src = $dir. $a[3] . "/" . $b[$i];
  $file = loadFile($src);
  echo "<p class=\"$b[$i]\">" . substr($file[findInLine("legend:",$file)], 7) . "</p> ";
}
echo " </div>";

for ($i=4; $i < sizeof($b); $i++) {
  $target = "<?php $nProject=$index ?>" ;
  $index ++;
  if(file_exists($dir . $a[3] . "/" . $b[$i] . "/label.jpg")){
    echo "<a href=\"" . $b[$i] . "\"  class=\"accueilBtn\" onmouseover=\"legend(true,this)\" onmouseout=\"legend(false,this)\" projet=\"$b[$i]\">";
    echo "<img src=\"" . $dir . $a[3] . "/" . $b[$i] . "/label.jpg" . "\">";
    echo "</img> </a>";
  }
}

?>
