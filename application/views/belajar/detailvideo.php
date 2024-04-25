<div class="row justify-content-md-center">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-8">
                        <h3><?=$g_video['judul']?></h3>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-md-9">
                        <video controls style="width: 100%;">
                            <source src="<?php echo base_url('assets/dist/video/' . $g_video['video']); ?>" type="video/mp4" size="720">
                            <!-- Fallback for browsers that don't support the <video> element -->
                            <a href="<?=base_url()?>assets/dist/video/<?=$g_video['video']?>" download>Download</a>
                        </video>
                        <p class="text-muted">Kreator : <b><?=$g_video['first_name']?> <?=$g_video['last_name']?></b></p>
                    </div>
                    <div class="col-md-3">
                      <h3><b>Deskripsi</b></h3>
                        <div>
                            
                            <p><?=$g_video['deskripsi']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    video {
        width: 85%;
        margin-top: 15px;
        height: fit-content;
    }
</style>
