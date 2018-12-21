/**
	顯示編輯留言
**/
function showEdit(element){
	let postAction = element.closest(".postAction");
	$(postAction.querySelector(".postAction__textarea")).show(400);
	$(postAction.querySelector(".postAction__edit--submit")).show(400);
	$(postAction.querySelector(".postAction__edit--cancel")).show(400);
	$(postAction.querySelector(".postAction__edit--show")).hide();
	$(postAction.previousElementSibling).hide();
}

/**
	取消編輯留言
**/
function cancelEdit(element){
	let postAction = element.closest(".postAction");
	$(postAction.querySelector(".postAction__textarea")).hide();
	$(postAction.querySelector(".postAction__edit--submit")).hide();
	$(postAction.querySelector(".postAction__edit--cancel")).hide();
	$(postAction.querySelector(".postAction__edit--show")).show();
	$(postAction.previousElementSibling).show();
}


/**
	將子留言轉換為ajax的方式執行。
**/
function addSubComments(element){
	const contnet = $(element).find("textarea[name=contnet]").val();
	$(element).find("textarea[name=contnet]").val("");
	const parentId = $(element).find("input[name=parentId]").val();
	$.ajax({
		type: 'POST',
		url: 'add_comments.php',
		data: {
			contnet: contnet,
			parentId: parentId
		},
		success: function(resp) {
			let res = JSON.parse(resp);
			console.log(res);
			if(res.rtnCde === "success"){
				$(element).parents(".main__post").find(".main__post__subfrom").before(`
				<div class="main__subpost main__subpost--self">
					<div class="main__subpost__info">
						<div class="main__subpost__info--name">
							${res.crt_user}
						</div>
						<div class="main__subpost__info-time">
							${res.crt_time}
						</div>
					</div>
					<div class="main__subpost__comment--text">
						${res.contnet}
					</div>
					<div class="postAction">
						<div class="postAction__edit">
							<form action="edit_comments.php" method="POST">
								<div class="margin-bot-10">
									<textarea class="postAction__textarea wt-90" name="contnet" placeholder="留言內容" style="display: none;">${res.contnet}</textarea>
								</div>
								<input type="hidden" name="commentId" value="${res.id}">
								<button type="submit" class="btn postAction__edit--submit" style="display: none;">送出</button>
								<button type="button" class="btn postAction__edit--cancel" style="display: none;">取消</button>
								<button type="button" class="btn postAction__edit--show" value="edit">編輯</button>
							</form>
						</div>
						<div class="postAction__del">
							<input type="hidden" name="commentId" value="${res.id}">
							<button type="submit">刪除</button>
						</div>
					</div>
				</div>`);
			}
		},
		error: function() {

		}
	});
}

/**
	將主留言轉換為ajax的方式執行。
**/
function addMainComments(element){
	const contnet = $(element).find("textarea[name=contnet]").val();
	$(element).find("textarea[name=contnet]").val("");
	const parentId = $(element).find("input[name=parentId]").val();
	$.ajax({
		type: 'POST',
		url: 'add_comments.php',
		data: {
			contnet: contnet,
			parentId: parentId
		},
		success: function(resp) {
			let res = JSON.parse(resp);
			if(res.rtnCde === "success"){
				$(".main__posts").prepend(`
				<div class="row">
					<div class="main__post col div-border">
						<div class="main__post__info">
							<div class="main__post__info--name">
								${res.crt_user}
							</div>
							<div class="main__post__info-time">
								${res.crt_time}
							</div>
						</div>
						<div class="main__post__comment--text">
							${res.contnet}
						</div>
							<div class="postAction">
								<div class="postAction__edit wt-90">
									<form action="edit_comments.php" method="POST">
										<div class="margin-bot-10">
											<textarea class="postAction__textarea wt-100" name="contnet" placeholder="留言內容" style="display: none;">${res.contnet}</textarea>
										</div>
										<input type="hidden" name="commentId" value="${res.id}">
										<button type="submit" class="btn postAction__edit--submit" style="display: none;">送出</button>
										<button type="button" class="btn postAction__edit--cancel" style="display: none;">取消</button>
										<button type="button" class="btn postAction__edit--show" value="edit">編輯</button>
									</form>
								</div>
								<div class="postAction__del">
									<input type="hidden" name="commentId" value="${res.id}">
									<button class="postAction__del--submit" value="del">刪除</button>
								</div>
							</div>
						<div class="main__post__subfrom">
							<div class="main__post__subfrom--nickname">
								${res.crt_user}
							</div>
							<div class="main__post__subfrom--textarea">
								<textarea name="contnet" placeholder="留言內容"></textarea>
							</div>
							<div>
								<input type="button" value="留言">
							</div>
							<input type="hidden" name="parentId" value="${res.parentId}">
						</div>
					</div>
				</div>`);
			}
		},
		error: function() {

		}
	});
}

/**
	將刪除留言轉換為ajax的方式執行。
**/
function delComments(element){
	if($(element).val() === "del"){
		$(element).text("確認刪除")
		$(element).val("confirm");
		$(element).addClass("btn-danger");
		$(element).mouseout(()=>{
			$(element).removeClass("btn-danger");
			$(element).text("刪除")
			$(element).val("del");
		});
	}
	else{
		delElement = $(element).parents(".postAction__del");
		const commentId = $(delElement).find("input[name=commentId]").val();
		$.ajax({
			type: 'POST',
			url: 'del_comments.php',
			data: {
				commentId: commentId
			},
			success: function(resp) {
				$(delElement).parent("div").parent("div").remove();
			},
			error: function() {
				
			}
		});
	}
}

$(document).ready(function(){
	/**
		主留言轉換為 ajax
	**/
	$(".main__from").find("input[type=button]").bind("click", ()=>{
		addMainComments($(".main__from"));
	});

	/**
		子留言轉換為 ajax
	**/
	$(".main__posts").on("click", ".main__post__subfrom input[type=button]", (element) => {
		addSubComments($(element.currentTarget).parents(".main__post__subfrom"));
	});

	/**
		顯示編輯區域。
	**/
	$(".main__posts").on("click", ".postAction__edit--show", (element) => {
		showEdit(element.currentTarget);
	});

	/**
		隱藏編輯區域。
	**/
	$(".main__posts").on("click", ".postAction__edit--cancel", (element) => {
		cancelEdit(element.currentTarget);
	});

	/**
		刪除留言
	**/
	$(".main__posts").on("click", ".postAction__del--submit", (element) => {
		delComments(element.currentTarget);
	});

	$("body").on("click", ".subfromFrom--show", (element) => {
		$(element.currentTarget).hide(300, () => {
			$(element.currentTarget).parent().prev().show(400);
		});
	});

});