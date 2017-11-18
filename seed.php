<?php

# let people know if they are running an unsupported version of PHP
if(phpversion() < 5) {
  die('<h3>Sorry this website requires PHP/5.0 or higher.<br>You are currently running PHP/'.phpversion().'.</h3><p>You should contact your host to see if they can upgrade your version of PHP.</p>');
}

if (isset($_GET['dir'])){
  $dir = $_GET['dir'];
}else{
   $dir = "pages";
}


?>

<html>

    <head>

        <title>Quince CMS</title>
        <meta charset="utf-8" />

        <link rel="stylesheet" href="style.css">

        <!-- <script src="sketch.js" type="text/javascript"></script> -->

        <link rel="icon" href=""/>

    </head>

    <body>
      <?php

        /*

        Le chemin est sauvegardé dans l'url sous le nom $dir, que je double dans la variable $path

        fonctions utiles
        bool is_dir ( string $filename ); Indique si le fichier est un dossier.
        */

        $root = "pages";


        echo "<h1>Quince is lunch</h1><br>";

        echo "filename  = " . $dir . "</br>";
        echo "root  = " . $root . "</br>";
        echo " </br>";

        if (file_exists($filename."/template.html")) {
            #echo "The file $filename exists";
        } else {
            #echo "The file $filename does not exist";
        }

        function dirLength($path){
          $files = count(scanDir($path))-3;
          return $files;
        }

        function createBranch($dir, $lvl){
          if ($lvl == null){
            $lvl = 0;
          }
          // echo "dir= " . $dir . " || length= " . dirLength($dir) . " || level = " . $lvl . "<br>";

           $files = array_reverse(scanDir($dir));
          // print_r ($files);
          for ($i=0; $i < dirLength($dir); $i++) {
            if(is_dir ($dir . "/" . $files[$i] )){
                // echo "dir :" . $files[$i] . "<br>";
                echo "<div id=\"" .$files[$i] ."\" lvl =\"".$lvl."\">";
                createBranch($dir . "/" . $files[$i], $lvl + 1 );
                echo "</div>";
          //     // menu($start . "/" . $files[$i]);
            //  } else if ($files[$i] == "label.jpg") {
            //     echo "<img src=\"" . $dir . "/" . $files[$i] . "\">";
            //  }else{
              // echo "file :" . $files[$i] . "<br>";
            }
          }
        }

        function createTree($from){
          if (dirLength($from) <= 0) {
            return null;
          }

          echo "<div id=\"treeStructure\">";

          createBranch($from);

          echo "</div>";
        }

        // function loadMenu($from){
        //   if($from == null){
        //     global $root;
        //     $from = $root;
        //   }else{
        //
        //   }
        //   echo $from;
        // }

        /* =======================================

        Ensemble de fonction permetant de charger le contenus d'un dossier.

        =======================================  */


        function loadContent($path){
          if(file_exists($path)){
            $myFile = fopen($path, "r");
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

        function loadImage($path){

        }


        /* =======================================

        Preload fonctions

        Charge les differents éléments <img> <p> <a> <script> etc dans une balise element(le nom n'est pas définitif)

        =======================================  */


        function preloadFolder($path){
          if($path == null){
             global $root;
             $path= $root;
           }

          if(is_dir ($path) != 1){
            return;
          }

          $files = array_reverse(scanDir($path));
          for ($i=0; $i < dirLength($path); $i++) {
            if($files[$i] == "content.txt"){
              preloadFiles($path);
            }
          }
        }

        function preloadFiles($path){
          $mainFile = $path . "/content.txt";
          if(file_exists($mainFile)){
            $lines = loadContent($mainFile);
          }else{
            return;
          }

          $i = 0;
          while ($i <= sizeof($lines)) {
            if (preg_match("/^#.*\n/",$lines[$i]) == 1){
              if ($i != 0){
                echo "</div>";
              }
              echo "<div id=\"" . substr($lines[$i],1) . "\">";
            }else if(preg_match("/^[.].*\n/",$lines[$i]) == 1){
              if ($i != 0){
                echo "</div>";
              }
              echo "<div class=\"" . substr($lines[$i],1) . "\">";
            }else{
              if(preg_match("/\[.*\]/",$lines[$i])){
                $filename = substr(substr($lines[$i],1),-1);
                echo $filename;
                if(preg_match("/(.jpg)]/",$lines[$i])){
                  echo $filename;
                  //loadImg();
                }
              }else{
                echo "simple line";
                echo "<p>".$lines[$i]."</p>";
              }

            }
            $i ++;
          }
        }

        // createTree($root);
        preloadFolder($root."/articles/QuinceCMS");

       ?>


      <?php
        // include ("index.html");
       ?>


    </body>

</html>
