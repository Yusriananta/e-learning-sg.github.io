<div class="container">
    <div class="row mt-4">
        <div class="col">
        <form>
            <div class="form-group">
                <div class="form-group">
                  <label for="sel1">Select Kreator:</label>
                  <select class="form-control" id="sel1">
                    <?php foreach ($listuser as $k):  ?>
                      <!-- <option><?= $id++; ?></option> -->
                      <option><?= $k['first_name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
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
                <label for="thumnall">Thumnall</label>
                <input type="file" id="thumnall" name="thumnall">
                <p class="help-block">Hanya file gambar (jpg/jpeg/png) max 2 mb</p>
            </div>
            <div class="form-group">
                <label for="video">Video Pembelajaran</label>
                <input type="file" id="video" name="video">
                <p class="help-block">Hanya file video (mp4) max 200 mb</p>
            </div>
            <button type="submit" class="btn btn-danger">Upload</button>
        </form>
        </div>
    </div>
</div>