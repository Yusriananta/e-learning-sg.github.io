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
            </div>


          <div class="row">
            <?php $no=1; foreach ($l_video as $v): ?> 
              <div class="col-sm-3 col-md-2">
              <div class="card h-100">
                <div class="thumbnail">
                <img src="<?= base_url('./uploads/'.$v->nama_tumbnail)?>" class="img-fluid">
                  <div class="caption">
                    <h3><?= $v->judul?></h3>
                    <p><?= $v->deskripsi?></p>
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
              <?php endforeach; ?> 
          </div>
    <!-- onclick="playVideo('video1.mp4') -->


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