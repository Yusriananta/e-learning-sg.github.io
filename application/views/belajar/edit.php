<div class="container">
    <div class="row mt-4">
        <div class="col">
        <?php echo $this->session->flashdata('message');?>
        <?php echo form_open_multipart('belajar/update_a');?>
            <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id" placeholder="max 30 karakter" value="<?= $g_video['id'] ?>" required>
            </div>
            <div class="form-group">
                  <label for="creator">Select Kreator:</label>
                  <select class="form-control" id="creator" name="creator" required>
                    <option value="<?= $g_video['id'] ?>"><?= $g_video['first_name'] ?></option>
                  <?php 
                        foreach ($listuser as $u ) {
                        ?>
                        <option value="<?= $u->id?>"><?= $u->id ?></option>
                        <?php
                        }
                    ?>
                  </select>
              </div>
            <div class="form-group">
                <label for="judul">Judul Pembelajaran</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="max 30 karakter" value="<?= $g_video['judul'] ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="max 70 karakter" required><?= $g_video['deskripsi']?></textarea>
            </div>
            <div class="form-group">
                <label for="tumbnail">Video</label>
                <div class="container" id="videoContainer">
                <div class="row">
                    <div class="col-md-4">
                     
                         <!-- Added anchor tag here -->
                          <div class="thumbnail">
                            <img src="<?= base_url('./assets/dist/thumbnail/'). $g_video['thumbnail']?>" class="img-thumbnail">
                            <div class="caption">
                             
                            </div>
                          </div>
                         <!-- Closing anchor tag here -->
                      
                    </div>
                </div>
              </div>
            </div>
            
            <button id="submit" class="btn btn-danger">Edit</button>
        </form>
        </div>
    </div>
</div>

<style>
.thumbnail img {
  width: 100%;
  height: 250px; /* Set the height as needed */
  object-fit: cover;
}
</style>