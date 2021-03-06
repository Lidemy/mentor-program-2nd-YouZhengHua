let pages = document.querySelector("#pages").value;
let pageArray = [];
for(let i = 1; i <= pages; i++){
	pageArray.push(".main__post--page"+i.toString());
}

function changePage(showPage){
	pageArray.forEach((arrayElement, index) =>{
		if(index == showPage){
			document.querySelectorAll(arrayElement).forEach((pageElement) => {
				pageElement.style.display = "block";
			});
		}
		else{
			document.querySelectorAll(arrayElement).forEach((pageElement) => {
				pageElement.style.display = "none";
			});
		}
	});
}

function createChangePageButton(){
	pageArray.forEach((arrayElement, index) =>{
		let btn = document.createElement("BUTTON");
		let t = document.createTextNode("Page " + (index+1).toString());
		btn.className = "main__pageButton";
		btn.value = index;
		btn.addEventListener("click", (element) => {
			changePage(element.target.value);
			document.querySelectorAll(".main__pageButton").forEach((buttonElement) => {
				buttonElement.disabled = false;
			});
			element.target.disabled = true;
			document.body.scrollTop = 0;
		});
		btn.appendChild(t);
		document.querySelector(".main__page").appendChild(btn);
	});
}

createChangePageButton();
document.querySelectorAll(".main__pageButton")[0].dispatchEvent(new Event("click"));

document.querySelectorAll(".postAction__edit--onclick").forEach((domElement) => {
	domElement.addEventListener("click", (element) => {
		console.log("123");
		let actionArea = domElement.closest(".postAction");
		if(domElement.value === "edit"){
			actionArea.querySelector(".postAction__textarea").style.display = "block";
			actionArea.querySelector(".postAction__edit--submit").style.display = "inline-block";
			actionArea.previousElementSibling.style.display = "none";
			domElement.value = "cancel";
			domElement.innerText = "取消";
		}
		else{
			actionArea.querySelector(".postAction__textarea").style.display = "none";
			actionArea.querySelector(".postAction__edit--submit").style.display = "none";
			actionArea.previousElementSibling.style.display = "block";
			domElement.value = "edit";
			domElement.innerText = "編輯";
		}
		
		
	});
});