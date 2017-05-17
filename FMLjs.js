
/* 
	FMLjs v1.0 (c) 2017 by Thielicious
	thielicious.github.io
	
	FMLjs is a plugin that parses FML(Forum Markup Language) 
	commands in a post or topic contents. Simply define the 
	target ID of your DOM Element and use any of these prototypes.
*/


function FMLjs(elem = null) {

	this.size;
	this.color;
	this.elem = elem || null;

	this.msg = (str) => {
		var prefix = '[FMLjs]\n\nError: ';
		return alert(prefix+str);
	}

	this.body = (script) => {
		if (this.elem == null) {
			var elem = document.getElementById(this.elem);
			if (typeof elem == 'undefined' && elem == null) {
				elem.innerHTML += script; 	
			} else if (typeof elem != 'undefined' && elem != null) {
				elem = document.getElementsByClassName(this.elem)[0];
				elem.innerHTML += script;
			} else {
				this.msg('Target element not found.');
			}
		} else {
			this.msg('You haven\'t defined the target element yet.');
		} 
	}

	FMLjs.prototype.target = (tg) => {
		this.elem = tg; 
	}

	FMLjs.prototype.h = (size) => {
		this.size = size;
		this.body('h'+this.size+'[(h1-h6 works)<Text>]'); 
	}

	FMLjs.prototype.c = (color) => {
		this.color = color;
		this.body('c'+this.color+'[<Text>]'); 
	}

	FMLjs.prototype.a = () => { this.body('a[<URL>]') }
	FMLjs.prototype.b = () => { this.body('b[<Text>]') }
	FMLjs.prototype.u = () => { this.body('u[<Text>]') }
	FMLjs.prototype.i = () => { this.body('i[<Text>]') }
	FMLjs.prototype.q = () => { this.body('q[<Text>]') }
	FMLjs.prototype.hr = () => { this.body('hr[<Text or leave blank>]') }
	FMLjs.prototype.img = () => { this.body('img[<Image URL>]') }
	FMLjs.prototype.yt = () => { this.body('yt[<YouTube ID Only>]') }
};

/* Example
	var fml = new FMLjs('content');
	fml.a()
	fml.yt();
	fml.c(2);
	fml.h(1);
	...
*/