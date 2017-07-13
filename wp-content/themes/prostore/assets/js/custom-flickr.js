jQuery(function() {
	jQuery('#flickr').jflickrfeed({
		limit: dankov_flickr.number,
		qstrings: {
			id: ''+dankov_flickr.id+'',
			tags: ''+dankov_flickr.tags+'',
	}, itemTemplate: 
			'<li>' +
				'<a rel="prettyPhoto[flickr_gallery]" href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a>' +
			'</li>' 
	}, function(data) {
		jQuery('#flickr a').prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
	});							
});							
