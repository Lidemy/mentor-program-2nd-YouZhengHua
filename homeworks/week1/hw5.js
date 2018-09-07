function join(arr, concatStr) {
	var rtnStr = "";
	for(var i = 0; i < arr.length; i++){
		rtnStr = i != 0 ? rtnStr + concatStr + arr[i].toString() : arr[i].toString(); 	
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
