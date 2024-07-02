<div class="cotainer">
  <div class="row">  
    <div class="col-md-6 col-md-offset-3 mb-3">
      <div class="input-group">
        <input id="search" name="search" type="text" class="form-control" placeholder="Cari Pembelajaran...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button" onclick="search()"><i class="fa fa-search"></i></button>
        </span>
      </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
    <div class="col">
      <a href="<?=base_url('belajar/add')?>" class="btn btn-primary"><i class="fa fa-upload"></i> Upload video</a>
    </div> 
  </div>
  <?php echo $this->session->flashdata('message');?>
              <div class="container" id="videoContainer">
                <div class="row" id="subcontent">
                  <?php foreach ($l_video as $v): ?> 
                    <div class="col-md-4">
                      <div class="card h-100">
                         <!-- Added anchor tag here -->
                          <div class="thumbnail">
                            
                            <img src="<?= base_url('./assets/dist/thumbnail/'.$v->thumbnail)?>" class="img-thumbnail">
                            <div class="caption">
                            <a href="<?= base_url('belajar/detailvideo/'.$v->id) ?>">
                                <div class="video-title">
                                    <h4 class="text-left mt-1"><?= $v->judul?></h4>
                                </div>
                              </a>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="btn-group">
                                    <button class="btn btn-default glyphicon glyphicon-option-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a href="<?= base_url('belajar/edit/'. $v->id) ?>">Edit</a></li>
                                      <li><a href="<?= base_url('belajar/delete/'. $v->id) ?>">Delete</a></li>
                                    </ul>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <small class="text-muted pull-right">Last updated : <?= $v->tanggal?></small>
                                </div>
                                <div class="col-md-6">
                                  <small class="text-muted pull-right"><?= $v->views?>x ditonton</small>
                                </div>
                              </div>
                            </div>
                          </div>
                         <!-- Closing anchor tag here -->
                      </div>
                    </div>
                  <?php endforeach; ?> 
                </div>
              </div>


<style>
  .thumbnail img {
  width: 100%;
  height: 250px; /* Set the height as needed */
  object-fit: cover;
}

.thumbnail{
  position: relative;
}

.card {
  height: 100%;
}

.card-footer {
  position: absolute;
  bottom: 2px;
  width: 100%;
}

.video-title {
    max-height: 3em; /* Menyesuaikan dengan tinggi dua baris */
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2; /* Menampilkan maksimal dua baris */
    -webkit-box-orient: vertical;
    display: -webkit-box;
}

.caption{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #FFFF; /* Atur warna latar belakang sesuai kebutuhan */
    padding: 10px; /* Atur padding sesuai kebutuhan */
    color: #fff; /* Atur warna teks sesuai kebutuhan */
}

</style>

<script>
function search() {
    var searchValue = $("#search").val();
    $.ajax({
        url: base_url + "belajar/seacrh/",
        type: "POST",
        data: {search: searchValue },
        success: function(response) {
            var videos = JSON.parse(response);
            var html = ''; // Variable untuk menyimpan markup baru

                videos.forEach(function(video) {
                    html += `
                    <div class="row">
                      <div class="col-md-4">
                          <div class="card">
                              <div class="thumbnail">
                                <img src="${base_url}assets/dist/thumbnail/${video.thumbnail}" class="img-thumbnail">
                                <div class="caption">
                                  <a href="${base_url}belajar/detailvideo/${video.id}">
                                    <div class="video-title">
                                      <h4 class="text-left mt-1">${video.judul}</h4>
                                    </div>
                                  </a>
                              <div class="btn-group">
                                <button class="btn btn-default glyphicon glyphicon-option-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="<?= base_url('belajar/edit/'. $v->id) ?>">Edit</a></li>
                                  
                                  <li><a href="<?= base_url('belajar/delete/'. $v->id) ?>">Delete</a></li>
                                </ul>
                                </div>
                                  <small class="text-muted">Last updated: ${video.tanggal}</small>
                                </div>
                              </div>
                          </div>
                      </div>`;
                });

            // Ganti konten HTML di dalam #subcontent dengan yang baru
            $("#subcontent").html(html);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    }); 
}
</script>