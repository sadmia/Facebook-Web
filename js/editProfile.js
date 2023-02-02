"use strict";


let saveBtnWork = document.getElementById('saveBtnWork');
let linkWork = document.getElementById('linkWork');
let workAdd = document.getElementById('workAdd');

let nameUpdateSave = document.getElementById('nameUpdateSave');
let inputProName = document.getElementById('inputProName');
let length_count = document.getElementById('length-count');



saveBtnWork.addEventListener("click", function(event){
	
	if (workAdd.value == "") {
		event.preventDefault();
	}
})




length_count.innerHTML = 15 - inputProName.value.length;
inputProName.addEventListener("input",function(){
	if (inputProName.value.length > 15 || inputProName.value == "") {
		inputProName.style.borderColor = "red";
		length_count.style.color = "red";
	} else {
		inputProName.style.borderColor = "#333";
		length_count.style.color = "#333";
	}

	length_count.innerHTML = 15 - inputProName.value.length;
})