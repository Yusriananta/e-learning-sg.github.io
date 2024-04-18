<div class="cotainer">
  <div class="row">  
    <div class="col-md-6 col-md-offset-3 mb-3">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari Pembelajaran...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
        </span>
      </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
    <div class="col">
      <a href="<?=base_url('belajar/add')?>" class="btn btn-primary"><i class="fa fa-upload"></i> Upload video</a>
    </div> 
  </div>


  <div class="row">
      <div class="col-sm-3 col-md-2">
      <div class="card h-100">
        <div class="thumbnail">
        <img src="<?=base_url()?>assets/dist/thumnall/9.jpg" alt="Video 1">
          <div class="caption">
            <h3>judul video</h3>
            <p>Lorem ipsum dolor sit amet consectetur ading elit. Et, maiores.</p>
            <p><a href="<?=base_url('belajar/detailvideo')?>" class="btn btn-primary" role="button">Detail</a>
            <a href="<?=base_url('belajar/edit')?>" class="btn btn-default" role="button">Edit</a>
            <a href="<?=base_url('belajar/hapusvideo')?>" class="btn btn-danger" role="button">Hapus</a></p>
          </div>
          <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
        </div>
      </div>
  </div>

<!-- <ul class="dropdown-menu">
            <li><a href="<?=base_url('belajar/edit')?>">Edit</a></li>
            <li><a href="#">Hapus</a></li>
          </ul> -->


    <script>
        // JavaScript untuk memutar video ketika thumbnail diklik
        function playVideo(videoSrc) {
            var videoPlayer = document.createElement('video');
            videoPlayer.src = videoSrc;
            videoPlayer.controls = true;
            videoPlayer.autoplay = true;
            videoPlayer.style.maxWidth = '100%';
            videoPlayer.style.height = 'auto';
            videoPlayer.style.marginTop = '20px';

            var container = document.createElement('div');
            container.appendChild(videoPlayer);

            var closeButton = document.createElement('button');
            closeButton.textContent = 'Close';
            closeButton.onclick = function() {
                container.parentNode.removeChild(container);
            };

            container.appendChild(closeButton);

            document.body.appendChild(container);
        }
    </script>