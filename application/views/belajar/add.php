<div class="container">
    <div class="row mt-4">
        <div class="col">
            <?php if ($pesan = $this->session->flashdata('pesan')): ?>
                <? echo $pesan; ?>
            <?php endif;?>
        <form action="<?= base_url() ."belajar/upload_" ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                  <label for="creator">Select Kreator:</label>
                  <select class="form-control" id="creator" name="creator">
                  <option selected>Pilih Creator...</option>
                  <?php 
                        foreach ($listuser as $u ) {
                        ?>
                        <option value="<?= $u->id?>"><?= $u->first_name ?></option>
                        <?php
                        }
                    ?>
                  </select>
              </div>
            <div class="form-group">
                <label for="judul">Judul Pembelajaran</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="max 30 karakter">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="max 70 karakter"></textarea>
            </div>
            <div class="form-group">
                <label for="tumbnail">Gambar</label>
                <input type="file" id="tumbnail" name="thumbnail">
                <p class="help-block">Hanya file gambar (jpg/jpeg/png) max 2 mb</p>
            </div>
            <div class="form-group">
                <label for="video">Video Pembelajaran</label>
                <div class="col-mg-9">
                    <input type="file" id="video" name="video_up">
                </div>
                <p class="help-block">Hanya file video (mp4) max 200 mb</p>
            </div>
            <button id="submit" class="btn btn-danger">Upload</button>
        </form>
        </div>
    </div>
</div>

<script>

</script>