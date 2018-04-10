
jQuery(document).ready(function($) {
	const player = new Plyr('.plyr-simple-radio', {
		controls: [
			'play-large', 'play', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay'
		]
	});
});
