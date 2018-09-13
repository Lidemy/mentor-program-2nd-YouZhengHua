function stars(n) {
	var rtnArray = [];
	for(var i = 0; i < n; i++){
		rtnArray.push("*".repeat(i+1));
	}
	return rtnArray;
}

module.exports = stars;
