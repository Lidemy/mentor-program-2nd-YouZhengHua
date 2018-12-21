//當網頁完成載入時，執行以下動作 
$(document).ready(()=>{
	//新增代辦事項
	$(".container__items--add").bind("click", ()=>{
		let text = $(".content").val();
		if(text){
			$(".container__items").append(
				`<li>${text}<button class="container__items--del">X</button></li>`
			);
		}
		$(".content").val("");
	});

	//完成代辦事項事件觸發
	$(".container__items").on("click", "li", (element)=>{
		if(!$(element.target).hasClass("container__items--done")){
			$(element.target).addClass("container__items--done");
		}
		else{
			$(element.target).removeClass("container__items--done");
		}
	});

	//刪除代辦事項
	$(".container__items").on("click", ".container__items--del", (element)=>{
		$(element.target).parent("li").remove();
	});
})