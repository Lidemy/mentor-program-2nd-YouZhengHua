function reverse(str) {
	var rtnStr = "";
	for(var i = str.length - 1; i >= 0; i--){
		rtnStr += str.charAt(i);
	}
	console.log(rtnStr);
}
