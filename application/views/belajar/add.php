<div class="container">
    <div class="row mt-4">
        <div class="col">
        <?php echo $this->session->flashdata('message');?>

        <?php echo form_open_multipart('belajar/upload');?>
            <div class="form-group">
                  <label for="creator">Select Kreator:</label>
                  <select class="form-control" id="creator" name="creator" required>
                    <option value="">Pilih Creator</option>
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
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Tulis Judul disini" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Tulis Deskripsi disini" required></textarea>
            </div>
            <div class="form-group">
                <label for="tumbnail">Gambar</label>
                <input type="file" id="tumbnail" name="thumbnail" required>
                <p class="help-block">Hanya file gambar (jpg/jpeg/png) max 2 mb</p>
            </div>
            <div class="form-group">
                <label for="video">Video Pembelajaran</label>
                <div class="col-mg-9">
                    <input type="file" id="video" name="video" required>
                </div>
                <p class="help-block">Hanya file video (mp4) max 150 mb</p>
            </div>
            <button id="submit" class="btn btn-danger">Upload</button>
        <!-- </form> -->
        </div>
    </div>
</div>

<script>

</script>