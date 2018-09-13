function add(a, b) {
	var rtnStr = "";
	var carryNum = 0;
	var largerLength = a.length > b.length ? a.length : b.length;
	for(var i = 1; i <= largerLength; i++){
		var aNum = a.length-i >= 0 ? Number(a[a.length-i]) : 0;
		var bNum = b.length-i >= 0 ? Number(b[b.length-i]) : 0;
		var sum = aNum + bNum + carryNum;
		carryNum = sum >= 10 ? 1 : 0;
		sum = sum >= 10 ? sum - 10 : sum;
		rtnStr = sum.toString() + rtnStr;
		if(i == largerLength && carryNum == 1){
			rtnStr = carryNum + rtnStr;
		}
	}
	return rtnStr;
}

module.exports = add;
