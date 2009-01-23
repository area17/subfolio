// Browser Detect Lite  v1.01
// http://www.dithered.com/javascript/browser_detect/index.html
// modified by Chris Nott (chris@dithered.com)


function BrowserDetectLite() {
	var agent = navigator.userAgent.toLowerCase(); 
	
	// Browser version
	this.versionMajor = parseInt(navigator.appVersion); 
	this.versionMinor = parseFloat(navigator.appVersion); 

	// Browser name
	this.ns    = (agent.indexOf('mozilla')!=-1 && agent.indexOf('spoofer')==-1 && agent.indexOf('compatible') == -1 && agent.indexOf('opera')==-1 && agent.indexOf('webtv')==-1); 
	this.ns2   = (this.ns && this.versionMajor == 2); 
	this.ns3   = (this.ns && this.versionMajor == 3); 
	this.ns4   = (this.ns && this.versionMajor == 4); 
	this.ns4up = (this.ns && this.versionMajor >= 4); 
	this.ns6   = (this.ns && this.versionMajor == 5); 
	this.ns6up = (this.ns && this.versionMajor >= 5); 
	this.ie    = (agent.indexOf("msie") != -1); 
	this.ie3   = (this.ie && this.versionMajor < 4); 
	this.ie4   = (this.ie && this.versionMajor == 4 && agent.indexOf("msie 4.0") != -1); 
	this.ie4up = (this.ie && this.versionMajor >= 4); 
	this.ie5   = (this.ie && this.versionMajor == 4 && agent.indexOf("msie 5.0") != -1); 
	this.ie55  = (this.ie && this.versionMajor == 4 && agent.indexOf("msie 5.5") != -1);
	this.ie5up = (this.ie && !this.ie3 && !this.ie4); 
	this.ie6   = (this.ie && this.versionMajor == 4 && agent.indexOf("msie 6.0") != -1);
	this.ie6up = (this.ie && !this.ie3 && !this.ie4 && !this.ie5 && !this.ie55); 
	this.opera = (agent.indexOf("opera") != -1); 
	this.webtv = (agent.indexOf("webtv") != -1); 
	this.aol   = (agent.indexOf("aol") != -1); 
	
	// Javascript version
	this.js = 0.0;
	if (this.ns2 || this.ie3) this.js = 1.0 
	else if (this.ns3 || this.opera || (document.images && this.ie && !this.ie4up)) this.js = 1.1 
	else if ((this.ns4 && this.versionMinor <= 4.05) || this.ie4) this.js = 1.2 
	else if ((this.ns4 && this.versionMinor > 4.05) || this.ie5up) this.js = 1.3 
	else if (this.ns6up) this.js = 1.4 

	// Platform type
	this.win   = (agent.indexOf("win")!=-1 || agent.indexOf("16bit")!=-1);
	this.win32 = (agent.indexOf("win95")!=-1 || agent.indexOf("windows 95")!=-1 || agent.indexOf("win98")!=-1 || agent.indexOf("windows 98")!=-1 || agent.indexOf("winnt")!=-1 || agent.indexOf("windows nt")!=-1 || (this.versionMajor >= 4 && navigator.platform == "win32") || agent.indexOf("win32")!=-1 || agent.indexOf("32bit")!=-1);
	this.mac   = (agent.indexOf("mac")!=-1);
}
var is = new BrowserDetectLite();
