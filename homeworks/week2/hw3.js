function isPrime(n) {
	var rtnBool = n != 1;
	for(var i = 2; i < n; i++){
		if(n % i == 0){
			return false;
		}
	}
	return rtnBool;
}

module.exports = isPrime
