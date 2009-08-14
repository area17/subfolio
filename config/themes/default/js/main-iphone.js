/* -------------------------------------------------------------- 

main-iphone.js (light javascript for Subfolio on iPhone)
* Subfolio by AREA 17

-------------------------------------------------------------- */

(function() {

/* Listeners
-------------------------------------------------------------- */
	addEventListener("load", function(event) {
		gallery();
	}, false);


/* Functions
-------------------------------------------------------------- */	
	
	function $(id) { 
		return document.getElementById(id); 
	}
		
	function gallery() {
		if ($("gallery")) {
			var posters, div, img, wImg, hImg, wP, hP;
			var posters = $("gallery").getElementsByTagName('ul')[0].getElementsByTagName('li');
			for (var i=0; i < posters.length; i++) {
				div = posters[i].getElementsByTagName('a')[0].getElementsByTagName('div')[0];
				img = div.getElementsByTagName('img')[0];
				wImg = img.width;
				hImg = img.height;
				wP = posters[i].getElementsByTagName('a')[0].getElementsByTagName('p')[0].offsetWidth;
				hP = div.clientHeight;
				
				// If the image width is smaller than its container's then we align it horizontally
				if (wImg < wP) {
					// Setting the right width (based on the widest between the img and the filename)
					div.style.width = wP + "px";
					var m = wImg / 2;
					img.style.position = "absolute";
					img.style.left = "50%";
					img.style.marginLeft = "-" + m + "px";
				}

				// If the image height is smaller than its container's then we align it vertically
				if (hImg < hP) {
					var m = hImg / 2;
					img.style.position = "absolute";
					img.style.top = "50%";
					img.style.marginTop = "-" + m + "px";	
				}
			}
		} 
	}
	
})();