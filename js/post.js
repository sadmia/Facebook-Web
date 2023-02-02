"use strict";


let miniPhotoVideoBtn = document.getElementById('miniPhotoVideoBtn');
let photoVideoBtn = document.getElementById('photoVideoBtn');

let photoVideoAdd = document.getElementById('photoVideoAdd');
let postSubmitBtn = document.getElementById('postSubmitBtn');

let selectImg = document.getElementById('selectImg');
let inputText = document.getElementById('inputText');

let regPattern = /\.(jpe?g|png|gif|bmp|mp4)$/i;


photoVideoBtn.addEventListener("click", function(){
	photoVideoAdd.click();
})
miniPhotoVideoBtn.addEventListener("click", function(){
	photoVideoAdd.click();
})


		

photoVideoAdd.addEventListener("input", function(){
	let value = photoVideoAdd.value;
	let urlExt = value.split(".")[1];
	let url = URL.createObjectURL(this.files[0]);

	if (urlExt.match(regPattern)) {
		photoVideoBtn.style.display = "none";
		selectImg.style.display = "block";
		selectImg.src = url;
	} 

})


postSubmitBtn.addEventListener("click", function(event){
	if(photoVideoAdd.value == "" && inputText.value == ""){
		event.preventDefault();
	}
})