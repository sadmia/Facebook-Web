"use strict";

let hideViewBtn = document.getElementById('hideViewBtn');

let updateBtn = document.getElementById("updateBtn");

let fullName = document.getElementById("fullName");
let emailAddress = document.getElementById("emailAddress");
let phoneNumber = document.getElementById("phoneNumber");
let passBox = document.getElementById("passBox");
let femailGender = document.getElementById("femailGender");
let mailGender = document.getElementById("mailGender");

let worningTextRed = document.querySelector(".worningTextRed");

let regExp = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
let numberRegExp = /01[3,4,5,6,7,8,9][0-9]{8}$/;

console.log(hideViewBtn.className);






updateBtn.addEventListener("click", function(event){


	if (fullName.value.length >= 3 && fullName.value.length <= 15) {
		fullName.style.borderColor = "green";
	} else {
		fullName.style.borderColor = "red";
		event.preventDefault();
	}

	if (emailAddress.value.match(regExp)) {
		emailAddress.style.borderColor = "green";
	} else {
		emailAddress.style.borderColor = "red";
		event.preventDefault();
	}

	if (phoneNumber.value.match(numberRegExp)) {
		phoneNumber.style.borderColor = "green";
	} else {
		phoneNumber.style.borderColor = "red";
		event.preventDefault();
	}

	if (passBox.value.length >= 6 && passBox.value.length <= 20) {
		passBox.style.borderColor = "green";
	} else {
		passBox.style.borderColor = "red";
		event.preventDefault();
	}

	if (femailGender.checked == true || mailGender.checked == true) {
		worningTextRed.style.visibility = "hidden";
	} else {
		worningTextRed.style.visibility = "visible";
		event.preventDefault();
	}

});





let passViewCount = 0;
hideViewBtn.addEventListener('click', function(){
	passViewCount = passViewCount + 1;

	if (passViewCount == 1) {
		passViewCount = 1;
		hideViewBtn.className = "fas fa-eye";
		passBox.type = "text";
	} else if (passViewCount == 2) {
		passViewCount = 0;
		hideViewBtn.className = "fas fa-eye-slash";
		passBox.type = "password";
	}

});

