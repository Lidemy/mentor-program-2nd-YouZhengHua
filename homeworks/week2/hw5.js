function add(a, b) {
	var rtnStr = "";
	var carryNum = 0;
	for(var i = a.length - 1; i >= 0; i--){
		var sum = Number(a[i]) + Number(b[i]) + carryNum;
		carryNum = sum >= 10 ? 1 : 0;
		sum = sum >= 10 ? sum - 10 : sum;
		rtnStr = sum.toString() + rtnStr;
	}
	return rtnStr;
}

module.exports = add;
