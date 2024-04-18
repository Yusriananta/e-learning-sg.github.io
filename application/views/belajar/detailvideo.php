<div class="container">
    <div class="row mt-4">
        <div class="col">
        <video controls crossorigin playsinline poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
		 <source src="<?=base_url()?>assets/dist/video/tsukihime.mp4" type="video/mp4" size="720">
		

			<!-- Caption files -->
			<track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
					default>
			<track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">
			<!-- Fallback for browsers that don't support the <video> element -->
			<a href="<?=base_url()?>assets/dist/video/tsukihime.mp4" download>Download</a>
	      </video>
          <!-- <small class="glyphicon glyphicon-eye-open"></small> -->
          <p class="text-muted">Dilihat : 90x</p>
          <h3>judul video</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia aliquam excepturi illo adipisci tempore. Fugiat reprehenderit sit magni alias officiis corrupti iste ullam adipisci cum excepturi! Impedit expedita ullam quos?</p>
        </div>
    </div>
</div>

<script>
  const player = new Plyr('video', {captions: {active: true}});

// Expose player so it can be used from the console
  window.player = player;
</script>