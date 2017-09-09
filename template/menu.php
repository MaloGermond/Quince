<?php
  $dir = "content/";
  $a = scandir($dir);

  for ($i=3; $i < sizeof($a); $i++) {
    $sub = $dir . $a[$i];
    $b = scandir($sub);
    // echo sizeof($b);

    echo "<ul id=" . substr($a[$i], 2) . ">";
    if(sizeof($b) < 4){
          echo "<li> <a href=\"" . substr($a[$i], 2) . "\"> <div class=\"menuBtn\"> "  . substr($a[$i], 2) . "</div> </a> </li>";
      }else{
        for ($j = 4; $j < sizeof($b); $j++) {
          echo "<li> <a href=\"" . $b[$j] . "\"> <div class=\"menuBtn\"> "  . str_replace("-"," ",$b[$j]) . "</div> </a> </li>";
          // echo "<li> <a href=\"index.php?nProject=" . $a[$i] . "\"> <div class=\"menuBtn\"> "  . substr($a[$i], 2) . "</div> </a> </li>";
        }
      }
    echo "</ul>";
  }
?>
