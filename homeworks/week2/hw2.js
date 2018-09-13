function alphaSwap(str) {
	var rtnStr = "";
	for(var i = 0; i < str.length; i++){
		rtnStr += str[i] == str[i].toUpperCase() ? str[i].toLowerCase() : str[i].toUpperCase();
	}
	return rtnStr;
}

module.exports = alphaSwap
