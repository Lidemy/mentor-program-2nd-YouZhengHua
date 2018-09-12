function isPrime(n) {
	var rtnBool = n != 1;
	for(var i = 2; i < n; i++){
		rtnBool = n % i == 0;
		if(!rtnBool){
			break;
		}
	}
	return rtnBool;
}

module.exports = isPrime
