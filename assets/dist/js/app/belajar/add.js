$(document).ready(function () {
  const player = new Plyr('video', {captions: {active: true}});

// Expose player so it can be used from the console
  window.player = player;
	require([
        'jquery',
        'plyr'
        ], function () {
            'use strict';
            const players = Array.from(document.querySelectorAll('.js-player')).map(p => new Plyr(p));
    });

	player.on('ready', (event) => {
    const instance = event.detail.plyr;

    });
    element.addEventListener('ready', (event) => {
    const player = event.detail.plyr;
    });

    
 
});