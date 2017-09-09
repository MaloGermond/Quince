<?php

# let people know if they are running an unsupported version of PHP
if(phpversion() < 5) {

  die('<h3>Sorry this website requires PHP/5.0 or higher.<br>You are currently running PHP/'.phpversion().'.</h3><p>You should contact your host to see if they can upgrade your version of PHP.</p>');

}
if (isset($_GET['nProject'])){
  $nProject = $_GET['nProject'];
}else{
   $nProject = "accueil";
}

?>

<html>

    <head>

        <title>Quince CMS</title>
        <meta charset="utf-8" />

        <link rel="stylesheet" href="global.css">

        <script src="sketch.js" type="text/javascript"></script>

        <script language="javascript" type="text/javascript" src="slideshow.js"></script>

        <link rel="icon" href="" />

    </head>


    <body>

      <div id="header" >
      </div>

      <div id="container">
      </div>

      <div id="footer">

      </div>

      <div id="gallery" onClick="displayGalleryById(event, 'gallery')">
          <div id="slides" >
            <script type="text/javascript">
              if(screen.width >= 1500){
                loadSlides()
              }
        		</script>
        </div>
        <div id="navGallery">
              <div id="previousImg" class="navigationBtn" onclick="previous(50)">
                <object data="assets/previous.svg" type="image/svg+xml">
                </object>
                <p>Précédant</p>
              </div>

              <div id="nextImg" class="navigationBtn" onclick="next(50)" >
                <object data="assets/next.svg" type="image/svg+xml">
                </object>
                <p>Suivant</p>
              </div>

              <div id="closeIco" class="navigationBtn" onclick="displayGallery(event)" >
                <object data="assets/cancel.svg" type="image/svg+xml">
                </object>
                <p>Fermer</p>
            </div>


          </div>
        </div>


</body>

</html>
