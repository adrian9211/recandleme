// Get the modal
var modal = document.getElementById("shopModal");
var modalImg = document.getElementById("shopImg");
var captionText = document.getElementById("shopCaption");

function showModal(imgs) {
    modal.style.display = "block";
    
    
    let text1 = imgs.src;
    let text2 = text1.replace(/^.*[\/]/g,'shop/lg/');

    modalImg.src = text2;

    captionText.innerHTML = imgs.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("shop-close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}