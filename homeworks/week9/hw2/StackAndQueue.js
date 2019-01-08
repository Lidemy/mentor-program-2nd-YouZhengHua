function Stack(){
	this.length = 0;
	this.stackObject = {};
	this.push = (obj) => {
		this.length ++;
		this.stackObject[this.length] = obj;
	}
	this.pop = () => {
		if(this.length > 0){
			let popObject = this.stackObject[this.length];
			delete this.stackObject[this.length];
			this.length --;
			return popObject;
		}
		else{
			return undefined;
		}
	}
}

function Queue(){
	this.length = 0;
	this.queueObject = {};
	this.push = (obj) => {
		this.length ++;
		this.queueObject[this.length] = obj;
	}
	this.pop = () => {
		if(this.length > 0){
			let popObject = this.queueObject[1];
			for(let i = 1; i < this.length; i++){
				this.queueObject[i] = this.queueObject[i+1];
			}
			delete this.queueObject[this.length];
			this.length --;
			return popObject;
		}
		else{
			return undefined;
		}
	}
}

let obj1 = new Stack();
obj1.push(1);
obj1.push(2);
obj1.push(3);
obj1.push(4);
obj1.push(5);
console.log(obj1.pop());
console.log(obj1.pop());
console.log(obj1.pop());
console.log(obj1.pop());
console.log(obj1.pop());

let obj2 = new Queue();
obj2.push(1);
obj2.push(2);
obj2.push(3);
obj2.push(4);
obj2.push(5);
console.log(obj2.pop());
console.log(obj2.pop());
console.log(obj2.pop());
console.log(obj2.pop());
console.log(obj2.pop());