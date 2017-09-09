<?php
  $icone = "assets/";
  $dir = "content/";
  $a = scandir($dir);
  $dir = $dir. $a[3];
  $b = scandir($dir);


if($nProject != "accueil"){
  echo "<div id=\"navigation\">";
  if($nProject == "About-me"){
    echo "<a href=\"accueil\"> <div id=\"returnAccueil\" class=\"navigationBtn\"> <object data=\"assets/accueil.svg\" type=\"image/svg+xml\"> </object> <p> Accueil </p> </div> </a>";
  }else{

  for($i=3; $i < sizeof($b); $i++){
    if($nProject == $b[$i]){
      if($i-1 > 3){
        echo "<a href=\"" . $b[$i-1] . "\"> <div id=\"lastProject\" class=\"navigationBtn\"> <object data=\"assets/previous.svg\" type=\"image/svg+xml\"> </object> <p>" . str_replace("-"," ",$b[$i-1]) . "</p> </div> </a>";
      }
        echo "<a href=\"accueil\"> <div id=\"returnAccueil\" class=\"navigationBtn\"> <object data=\"assets/accueil.svg\" type=\"image/svg+xml\"> </object> <p> Accueil </p> </div> </a>";
      if($i+1 < sizeof($b)){
        echo "<a href=\"" . $b[$i+1] . "\"><div id=\"nextProject\" class=\"navigationBtn\"> <object data=\"assets/next.svg\" type=\"image/svg+xml\"> </object> <p>" . str_replace("-"," ",$b[$i+1]) ."</p> </img> </div> </a>";
      }
    }
  }
  }
  echo "</div>";
}


?>
