$(document).on('click', 'a[href^="#"]', function (event) {
	event.preventDefault();

	$('html, body').animate({
		scrollTop: $($.attr(this, 'href')).offset().top
	}, 500);
});

$(document).ready(function () {
	/* convert svgs */
	jQuery('img').filter(function() {
		return this.src.match(/.*\.svg$/);
	}).each(function(){
		var $img = jQuery(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		jQuery.get(imgURL, function(data) {
			// Get the SVG tag, ignore the rest
			var $svg = jQuery(data).find('svg');

			// Add replaced image's ID to the new SVG
			if(typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			// Add replaced image's classes to the new SVG
			if(typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass+' replaced-svg');
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a');

			// Replace image with new SVG
			$img.replaceWith($svg);
			$img.css("visibility","1");
		}, 'xml');
	});
});

function slideIn(el){
	$(el).css("visibility","");
	$(el).css("position","relative");
	$(el).css("opacity","0");
	$(el).css("left","-=200");
	$(el).animate({
		"opacity": 1,
		"left": "+=200"
	}, 1000);
}