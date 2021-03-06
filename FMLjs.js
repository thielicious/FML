/* 
	FMLjs v1.0 (c) 2017 by Thielicious
	thielicious.github.io
	
	FMLjs is a plugin that parses FML(Forum Markup Language) 
	commands in post or topic contents. Simply define the 
	target ID/class of your DOM Element and use any of these 
	prototypes.
*/


var FMLjs = function (elem = null) {

	var id, cls,
		regex = [/#/g,/\./g];

	this.elem = elem || null;

	this.msg = (str) => {
		var prefix = '[FMLjs]\n\nError: ';
		return alert(prefix+str);
	}

	this.verify = (dom, script) => {
		if (typeof dom != 'undefined') {
			dom.value += script;
		} else {
			this.msg(dom+' not found.');
		}
	}

	this.body = (script) => {
		if (this.elem != null) {
			if (regex[0].test(this.elem)) {
				id = this.elem.replace(regex[0],'');
				this.verify(document.getElementById(id),script);
			} else if (regex[1].test(this.elem)) {
				cls = this.elem.replace(regex[1],'');
				this.verify(document.getElementsByClassName(cls)[0],script);
			} else {
				this.msg('Target element must be a Class or ID.');
			}
		} else {
			this.msg('You haven\'t defined the target element yet.');
		} 
	}

	FMLjs.prototype.target = (tg) => { this.elem = tg }
	FMLjs.prototype.h = (size) => { this.body('h'+size+'[(h1-h6 works)<Text>]') }
	FMLjs.prototype.c = (color) => { this.body('c'+color+'[<Text>]') }
	FMLjs.prototype.a = () => { this.body('a[<URL>]') }
	FMLjs.prototype.b = () => { this.body('b[<Text>]') }
	FMLjs.prototype.u = () => { this.body('u[<Text>]') }
	FMLjs.prototype.i = () => { this.body('i[<Text>]') }
	FMLjs.prototype.q = () => { this.body('q[<Text>]') }
	FMLjs.prototype.hr = () => { this.body('hr[<Text or leave blank>]') }
	FMLjs.prototype.img = () => { this.body('img[<Image URL>]') }
	FMLjs.prototype.yt = () => { this.body('yt[<YouTube ID Only>]') }
}

/* Example
	var fml = new FMLjs('#content');
	optional: fml.target('#content');
	fml.a(); 
	fml.yt();
	fml.c(2);
	fml.h(1);
	...
*/