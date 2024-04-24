<div class="container">
    <div class="row mt-4">
        <div class="col">
        <?php echo $this->session->flashdata('message');?>
        <!-- <form action="<?= base_url() ."belajar/upload_1" ?>" method="post" enctype="multipart/form-data"> -->
        <?php echo form_open_multipart('belajar/upload_1');?>
            <div class="form-group">
                <div class="form-group">
                  <label for="sel1">Select Kreator:</label>
                  <select class="form-control" id="creator" name="creator" required>
                    <option value="">Pilih creator</option>
                  <?php 
                        foreach ($listuser as $u ) {
                        ?>
                        <option value="<?= $u->id?>"><?= $u->first_name ?></option>
                        <?php
                        }
                    ?>
                  </select>
                </div>
              </div>
            <div class="form-group">
                <label for="judul">Judul Pembelajaran</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="max 30 karakter" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="max 70 karakter" required></textarea>
            </div>
            <div class="form-group">
                <label for="thumbnail">Thumnall</label>
                <input type="file" id="thumbnail" name="thumbnail" required>
                <p class="help-block">Hanya file gambar (jpg/jpeg/png) max 2 mb</p>
            </div>
            <div class="form-group">
            <!-- <?php 
                // $error=$this->session->flashdata('error');
                // if (!empty($error)) {
                // if(is_array($error)){
                //     foreach ($error as $key => $value) {
                //     $err=$error[$key];
                //     if(is_array($err)){
                //         foreach ($err as $e) {
                //         echo "<span class='error'>".$e ."</span>";
                //         }
                //     }else{
                //         echo "<span class='error>".$error[$key]  ."</span>";
                //     }
                //     }
                // }else{
                //     echo "<span class='error'>".$error  ."</span>";
                // }
                // }

                // $file=$this->session->flashdata('file');
                // if (!empty($file)) {
                // ?>
                // <video width="320" height="240" controls>
                //     <source src="<?= base_url() ."./uploads/" .$file ?>" type="video/mp4">
                //     Your browser does not support the video tag.
                // </video> 
                // <?php
                // }
              ?> -->
                <label for="video">Video Pembelajaran</label>
                <input type="file" id="video" name="video" required>
                <p class="help-block">Hanya file video (mp4) max 100 mb</p>
            </div>
            <button id="submit" class="btn btn-danger">Upload</button>
        <!-- </form> -->
        </div>
    </div>
</div>

<script>

</script>