<div class="container">
    <div class="row mt-4">
        <div class="col">
        <form>
            <div class="form-group">
                <label for="judul">Judul Pembelajaran</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Judul" require="">
                <p class="help-block"> max 30 karakter</p>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi Pembelajaran"></textarea>
                <p class="help-block"> max 70 karakter</p>
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
            <button type="submit" class="btn btn-danger">Edit</button>
        </form>
        </div>
    </div>
</div>