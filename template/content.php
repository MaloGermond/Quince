<?php

$dir = "content/";
$a = scandir($dir);

//regex (date:)(.+)*(\n-) or (content:\n)(.+\n)*(-)
for ($i=3; $i < sizeof($a); $i++) {
$src = $dir. $a[$i] . "/" . $nProject;
  if($i == "3"){
    if(file_exists($dir. $a[3] . "/" . $nProject)){
      loadProject($src);
    }
  }else if( $i == "4"){
    if($nProject == "About-me"){
      if (file_exists($dir. $a[4] . "/" . "About-me")){
        loadPresentation($src);
      }
    }
  }
}

function loadPresentation($link){
  $src = $link;
  include ($link . "/cv.php");
}

function drawInfo($file){
  echo "<div id=\"info\" class=\"legend\">";
  echo "<p>" . substr($file[findInLine("title:",$file)], 7) . "</p>";
  echo "<p>" . substr($file[findInLine("date:",$file)], 6) . "</p>";
  if(strlen($file[findInLine("tag:",$file)]) > 4){
    echo "<p>Tag: " . substr($file[findInLine("tag:",$file)], 5) . "</p>";
  }
  if(strlen($file[findInLine("participation:",$file)]) > 15){
    echo "<p>Avec: " . substr($file[findInLine("participation:",$file)], 14) . "</p>";
  }
  if(strlen($file[findInLine("exposition:",$file)]) > 12){
    echo "<p>Exposition " . substr($file[findInLine("exposition:",$file)], 12) . "</p>";
  }
  echo "</div>";
}

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

function whichType($line){
  $pattern = "/\{\w*\w{1,}\}/";
  // $pattern = "/\{video\d{1,}\}/";
  // $ima = preg_grep($pattern,$line);
  if(preg_match("/\{(image)\w*\}(\(.+\))*/",$line) == 1){
    $type = "image";
  }else if (preg_match("/{video\w*\}/",$line) == 1){
    $type = "video";
  }else if (preg_match("/{gif\w*\}/",$line) == 1){
    $type = "gif";
  }else{
    $type = "string";
  }
  return $type;
}

function nameFile($el){
  // if(preg_match_all("/\{" . $type . "\w*\}/",$el) > 1){
  //   return "true";
  // }

  $type = whichType($el);

  // echo " el: ". $el;
  // echo " type: ". $type;


  if (preg_match("/\{(".$type.")\w*\}\(.+\)/", $el) == 1){
    $name = preg_split("/\(.+\)/", $el)[0];
    //echo substr($name,strlen($type)+1,strlen($type)-3);
    $tmp = substr($name,strlen($type)+1,strlen($type)-3);
    $name = $tmp;
    // echo $name;
    return $name;

  }else if (preg_match("/\[(\{(image)\w*\}\,)*\{(image)\w*\}\]/", $el) == 1){
    preg_match_all("/\{(image)\w*\}/", $el,$match);
    print_r ($match[0]);

  }else if (preg_match("/\{(".$type.")\w*\}/", $el) == 1){
    $tmp = substr($el,0,strlen($el)-2);
    $name = substr($tmp,strlen($type)+1);
    // echo $name;
    return $name;

  }else{
    return -1;
  }


}

function loadImage($src, $el, $num){
  $name = nameFile($el);
  $legend = false;

  if (preg_match("/\{(image)\w*\}\(.+\)/", $el)){
    $legend = true;
  }

  if(file_exists($src . "/" . $name . ".jpg") || file_exists($src . "/" . $name . ".JPG")){
    if($legend == true){
      echo "<div style=\"position:relative\">";
      loadLegend($el);

    }

    echo "<img src=\"" . $src . "/" . $name . ".jpg" . "\" onClick=\"showPictNum(event,".$num.")\" class=\"slideshow\"></img>";
    if($legend == true){
      echo "</div>";
    }

  }else{
    print_r("<p>error image file doesn't existe</p>");
  }
}

function loadVideo($src, $el){
    $name = nameFile($el);
    // echo $name;
    if(file_exists($src . "/" . $name . ".webm") || file_exists($src . "/" . $name . ".WEBM")){
      echo "<video controls autoplay=\"true\" loop=\"true\"> <source src=" . $src . "/" . $name . ".webm type=\"video/webm\" /> </video>";
    }else if(file_exists($src . "/" . $name . ".mp4") || file_exists($src . "/" . $name . ".MP4")){
      echo "<video controls autoplay=\"true\" loop=\"true\"> <source src=" . $src . "/" . $name . ".mp4 type=\"video/mp4\" /> </video>";
    // }else if(file_exists($src . "/" . $name . ".mp4") || file_exists($src . "/" . $name . ".MP4")){
    //   echo "<video controls> <source src=" . $src . "/" . $num . ".mp4 type=\"video/mp4\" /> </video>";
    // }else if(file_exists($src . "  /" . $name . ".ogv") || file_exists($src . "/" . $name . ".OGV")){
    //   echo "<video controls> <source src=" . $src . "/" . $name . ".ogv type=\"video/ogg\" /> </video>";
    }else{
      echo "<p>Sorry Your browser does not support the video tag. :s</p>";
    }
}

function loadGif($src, $el){
  $name = nameFile($el);
  if(file_exists($src . "/" . $name . ".gif") || file_exists($src . "/" . $name . ".GIF")){
          echo "<img src=\"" . $src . "/" . $name  . ".gif" . "\"  >" . "</img>";
        }else{
          // print_r("error gif file doesn't existe");
        }
}

function loadPHP($src, $name){
  if(file_exists($src . "/" . $name . ".php") || file_exists($src . "/" . $name . ".PHP")){
          echo "include (\'" . $src . "/" . $name . ".php\');";
        }else{
           print_r("error php file doesn't existe");
        }
}

function loadLegend($el, $type){
  if (preg_match("/\{(".$type.")\w*\}\(.+\)/", $el) == 1){
    echo "<div class=\"legend\">";
    echo "<p>" . substr($el,10,-2) . "</p>";
    echo "</div>";
  }
}

function loadSlideshow(){
  $slideshow = DOMDocument::getElementById ( 'slides' );
  $img = createElement('p', 'Ceci est l\'élément racine !');

  // Nous insérons le nouvel élément en tant que racine (enfant du document)
  $slideshow->appendChild($img);
  // echo $slideshow;
}

function findInLine($string,$src){
  return key(preg_grep("/($string)/", $src));
}

function loadProject($src){
  $line = loadFile($src);

  $startContent = key(preg_grep("/(content:)/", $line))+1;
  $endContent = key(preg_grep("/(---)/", $line))-1;
  if ($endContent == -1){
    $endContent = sizeOf($line);
  }



  // $pattern = "/\{\w*\d{1,}\}/";
  // $pattern = "/\{video\d{1,}\}/";
  // $el= preg_grep($pattern,$line);

  // print_r($el);
  // echo preg_match($pattern,$line[3]);

  // $list = preg_grep("/\[(\{\w*\d{1,}\}){2,}\]/",$line);
  // echo whichType($line[25]);

  echo "<div id=\"content\">";
  echo "<div style=\"position:relative\">";
  drawInfo($line);

  if(file_exists($src . "/header.jpg")){
    echo "<img src=\"" .  $src . "/header.jpg  \" style=\"cursor: default\" >" . "</img>";
  }
  echo "</div>";

  echo "<h1>" . substr($line[findInLine("title:",$line)], 7) . "</h1>";

  $numImg = 0;

  for ($i=$startContent; $i <= $endContent ; $i++) {
    $el = $line[$i];
    if (preg_match("/\{(.*)\d{2}\}\[.\]/",$el) == 1){
      echo "<div style=\"position:relative\">";

      $el = substr($line[$i],0,10);
    }

    // echo $el."  ".whichType($el)."<br>";


    if(whichType($el)=="image"){
        loadImage($src,$el,$numImg);
        $numImg ++;
    }
    if(whichType($el)=="gif"){
        loadGif($src,$el);
    }
    if(whichType($el)=="video"){
        loadVideo($src,$el);
    }
    if(whichType($el)=="string"){
        echo("<p>" . $el . "</p>");
    }
  }


}

?>
