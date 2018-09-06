function join(str, concatStr) {
	var rtnStr = "";
	for(var i = 0; i < str.length; i++){
		rtnStr = rtnStr.length > 0 ? rtnStr + concatStr + str[i].toString() : str[i].toString();
	}
	return rtnStr;
}

function repeat(str, times) {
	var rtnStr = "";
	for(var i = 0; i < times; i++){
		rtnStr += str.toString();
	}
	return rtnStr;
}
