"use strict";


let bio_edit_btn = document.getElementById("bio-edit-btn");
let bio_btn_click = document.querySelector(".bio-btn-click");
let bio_text = document.getElementById("bio-text");
let cencel_btn = document.getElementById("cencel-btn");
let save_btn = document.getElementById("save-btn");
let inputBioTextInput = document.getElementById("inputBioTextInput");
let bioLentht = inputBioTextInput.value.length;
let length_count = document.getElementById("length-count");

bio_edit_btn.addEventListener("click", function(){
	bio_btn_click.style.display = "block";
	bio_text.style.display = "none";
	bio_edit_btn.style.display = "none";
	length_count.innerHTML = 101 - bioLentht;
})

cencel_btn.addEventListener("click", function(event){
	bio_btn_click.style.display = "none";
	bio_text.style.display = "block";
	bio_edit_btn.style.display = "block";
	event.preventDefault();
})

inputBioTextInput.addEventListener("input", function(){
	length_count.innerHTML = (101 - inputBioTextInput.value.length);

	if (inputBioTextInput.value.length > 101) {
		inputBioTextInput.style.borderColor = "red";
		length_count.style.color = "red";
	} else {
		inputBioTextInput.style.borderColor = "#333";
		length_count.style.color = "#333";
	}
})

save_btn.addEventListener("click", function(){
	bio_btn_click.style.display = "none";
	bio_text.style.display = "block";
	bio_edit_btn.style.display = "block";
})


let likeBtn = document.getElementsByClassName('likeBtn');
let iconLkBtn = document.getElementsByClassName('iconLkBtn');
let lkText = document.getElementsByClassName('lkText');

for (let i = 0; i < likeBtn.length; i++) {

	if (likeBtn[i].value == 1) {
		lkText[i].innerHTML = "Liked";
		iconLkBtn[i].className = "fas fa-thumbs-up iconLkBtn";
		likeBtn[i].style.color = "#1877F2";
	} else {
		lkText[i].innerHTML = "Like";
		iconLkBtn[i].className = "far fa-thumbs-up iconLkBtn";
		likeBtn[i].style.color = "#333";
	}

	likeBtn[i].addEventListener("click", function(){
		
		if (likeBtn[i].value == 0) {
			lkText[i].innerHTML = "Liked";
			iconLkBtn[i].className = "fas fa-thumbs-up iconLkBtn";
			likeBtn[i].style.color = "#1877F2";
			likeBtn[i].value = "1";
		} else {
			lkText[i].innerHTML = "Like";
			iconLkBtn[i].className = "far fa-thumbs-up iconLkBtn";
			likeBtn[i].style.color = "#333";
			likeBtn[i].value = "0";
		}

	})
			
}

