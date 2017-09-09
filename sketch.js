/* ===========
// Navigation
============ */

/* ===========
// apercu photo
============ */
var gallery;
var imgShow = 0;
var slideIsLoad = false;


function displayGalleryById(event, id){
  if(event.target.id == id){
    displayGallery(event)
  }
}

function displayGallery(event){
  var gallery = document.getElementById('gallery');
  // var preview = document.getElementById('preview');
  //var navigation = document.getElementById('navGallery');

  // console.log(gallery.style.display);
  // console.log(window.getSelection());

  var x = event.clientX;
  var y = event.clientY;
  var elementMouseIsOver = document.elementFromPoint(x,y);
  // console.log(elementMouseIsOver);
    if(gallery.style.display == "inherit" || gallery.style.display == "" || gallery.style.display != "none" && elementMouseIsOver == gallery){
      gallery.style.display = "none";
    }

}

function loadSlides(){

  var slides = document.getElementById('slides')
  var elGallery = document.getElementsByClassName("slideshow")

  for (var i = 0; i < elGallery.length; i++) {
    slide = document.createElement("div")
    slide.setAttribute("id", "slide"+i)
    slide.setAttribute("class", "slide")
    slide.setAttribute("onClick", "displayGalleryById(event, \"slide"+i+"\")")


    source = elGallery[i].src
    // slide.innerHTML = src
    // slide.innerHTML = "<img>"
    img = document.createElement("img")
    img.setAttribute("src", source)

    slide.appendChild(img);
    // slide.appendChild(source.cloneNode(true));

    if(slideIsLoad == false){
      slides.appendChild(slide)
    }
  }

}

function showPictNum(event, num){
  showPict(event)
  jumpToSlide(num)
  posSlide = num
  // setTimeout(function() {jumpToSlide(num),1})
  // console.log(document.getElementById("slides").offsetLeft)
}

function showPict(event){
  if(screen.width >= 1500){

  var x = event.clientX;
  var y = event.clientY;
  var elementMouseIsOver = document.elementFromPoint(x,y);

  var info = document.getElementById('info');
  //console.log(info.childNodes[0].innerHTML);
  var project = info.childNodes[0].innerHTML;
  var date = info.childNodes[1].innerHTML;
  var legend = elementMouseIsOver.parentElement.childNodes[1].innerHTML;

  gallery = document.getElementById('gallery');
  gallery.style.display = "inherit";

  loadSlideshow("slides")


  // console.log(elementMouseIsOver.alt);
  // var preview = document.getElementById('preview');
  // preview.innerHTML = "";
  //
  // var src = elementMouseIsOver.src;
  // var img = document.createElement('img');
  // img.setAttribute("src", src);
  // preview.appendChild(img);
  //
  // var content = document.createElement('div');
  // content.id = "legendGallery";
  // content.innerHTML = "<h1>"+project+"</h1>";
  // content.innerHTML += "<p>"+date+"</p>";
  // content.innerHTML += "<p>"+legend+"</p>";
  //
  // preview.appendChild(content);



  // img = createElement(img);
  // img.setAttribute("src", distSrc);
  //
  // gallery.appendChild(img);
  }
}

function showPictById(id){
  var elGallery = document.getElementsByTagName("img");
  var target = elGallery[id];

  var info = document.getElementById('info');

  var project = info.childNodes[0].innerHTML;
  var date = info.childNodes[1].innerHTML;
  var legend = target.parentElement.childNodes[1].innerHTML;

  gallery = document.getElementById('gallery');
  gallery.style.display = "inherit";

  var preview = document.getElementById('preview');
  preview.innerHTML = "";

  var src = target.src;
  var img = document.createElement('img');
  img.setAttribute("src", src);
  preview.appendChild(img);

  var content = document.createElement('div');
  content.id = "legendGallery";
  content.innerHTML = "<h1>"+project+"</h1>";
  content.innerHTML += "<p>"+date+"</p>";
  content.innerHTML += "<p>"+legend+"</p>";

  preview.appendChild(content);

}

function legend(visible, target){

  if(screen.width >= 1200){
  el = document.getElementsByClassName(target.getAttribute("href"))
  // console.log(el);

    if(visible == true){
      for (var i = 0; i < el.length; i++) {
        el[i].style.opacity = 1;
        el[i].style.color = "black";
      }
    }else{
      for (var i = 0; i < el.length; i++) {
        el[i].style.opacity = 0.05;
        el[i].style.color = "#8f8f8f";
      }
    }

    btn = document.getElementsByClassName("accueilBtn")
    for (var i = 0; i < btn.length; i++) {
      if(btn[i].getAttribute("projet") == target.getAttribute("projet")){
        btn[i].style.filter =  "grayscale(0%)"
      }else{
        btn[i].style.filter =  "grayscale(80%)"
      }
    }

  }
}
