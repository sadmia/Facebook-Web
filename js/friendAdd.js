"use strict";


let likeBtn = document.getElementsByClassName('addFriendBtn');
let iconLkBtn = document.getElementsByClassName('iconChangeFriend');
let lkText = document.getElementsByClassName('addFriendText');

for (let i = 0; i < likeBtn.length; i++) {

	if (likeBtn[i].value == 1) {
		lkText[i].innerHTML = "Cancel request";
		iconLkBtn[i].className = "fas fa-check iconChangeFriend";
		likeBtn[i].style.color = "#333";
		likeBtn[i].style.borderColor = "#333";
	} else {
		lkText[i].innerHTML = "Add Friend";
		iconLkBtn[i].className = "fas fa-user-plus iconChangeFriend";
		likeBtn[i].style.color = "#1877F2";
		likeBtn[i].style.borderColor = "#1877F2";
	}

	likeBtn[i].addEventListener("click", function(){
		
		if (likeBtn[i].value == 1) {
			lkText[i].innerHTML = "Cancel request";
			iconLkBtn[i].className = "fas fa-check iconChangeFriend";
			likeBtn[i].style.color = "#333";
			likeBtn[i].style.borderColor = "#333";
			likeBtn[i].value = 1;
		} else if (likeBtn[i].value == 0) {} {
			lkText[i].innerHTML = "Add Friend";
			iconLkBtn[i].className = "fas fa-user-plus iconChangeFriend";
			likeBtn[i].style.color = "#1877F2";
			likeBtn[i].style.borderColor = "#1877F2";
			likeBtn[i].value = 0;
		}

	})
			
}