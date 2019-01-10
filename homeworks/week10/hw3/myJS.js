function items(str){
	this.content = str;
	this.status = "undone" // undone | done;
}

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

const itemList = [];

let showType = "all";

function render(showType){
	$(".items").empty();
	for(let i = 0; i < itemList.length; i++){
		const itmes = itemList[i].status === "done" 
			?`<li class="item list-group-item">
					<S>${escapeHtml(itemList[i].content)}</S>
					<button class="item__action item__action--done btn btn-outline-success btn-sm" id="items--add" type="button" value="undone" style="display: none" data-index="${i}">取消標記</button>
					<button class="item__action item__action--del btn btn-outline-danger btn-sm" id="items--add" type="button" style="display:none" data-index="${i}">刪除</button>
				</li>
			` 
			:`<li class="item list-group-item">
					${escapeHtml(itemList[i].content)}
					<button class="item__action item__action--done btn btn-outline-success btn-sm" id="items--add" type="button" value="done" style="display: none" data-index="${i}">標記完成</button>
					<button class="item__action item__action--del btn btn-outline-danger btn-sm" id="items--add" type="button" style="display: none" data-index="${i}">刪除</button>
				</li>
			`;
		if(showType === "all"){
			$(".items").append(itmes);
		}
		else if(showType === "done" && itemList[i].status === "done"){
			$(".items").append(itmes);
		}
		else if(showType === "undone" && itemList[i].status === "undone"){
			$(".items").append(itmes);
		}

	}
}

//當網頁完成載入時，執行以下動作 
$(document).ready(()=>{

	//新增代辦事項
	$("#items--add").bind("click", ()=>{
		const content = $("#userInput").val();
		if(content){
			itemList.push(new items(content));
			render(showType);
		}
	});

	$(".itmes--showtype").bind("click", (element)=>{
		$(".itmes--showtype").removeClass("active");
		$(element.target).addClass("active");
		showType = $(element.target).attr("value");
		render(showType);
	});

	$(".items").on("mouseover", ".item", (element)=>{
		$(element.target).children(".item__action").show();
	});

	$(".items").on("mouseout", ".item", (element)=>{
		$(element.target).children(".item__action").hide();
	});

	$(".items").on("click", ".item__action--done", (element)=>{
		const domElement = element.target;
		if($(domElement).val() === "done"){
			$(domElement).val("undone");
			$(domElement).text("取消標記");
			itemList[$(domElement).attr("data-index")].status = "done";
		}
		else if($(domElement).val() === "undone"){
			$(domElement).val("done");
			$(domElement).text("標記完成");
			itemList[$(domElement).attr("data-index")].status = "undone";
		}
		render(showType);
	});

	$(".items").on("click", ".item__action--del", (element)=>{
		itemList.splice($(element.target).attr("data-index"), 1);
		render(showType);
	});
})