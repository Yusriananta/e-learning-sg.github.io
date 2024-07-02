<?php if (!empty($message)): ?>
    <div class="alert alert-danger"><?= $message; ?></div>
<?php elseif (!empty($mhs)): ?>
    <div class="box box-danger">
        <div class="box-header box-danger with-border">
            <h3 class="box-title"><?= $subjudul ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
                    <button type="button" onclick="reload_ajax()" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-refresh"></i> Reload</button>
                </div>
            </div>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="table-responsive px-4 pb-3" style="border: 0">
            <table id="mhs" class="w-100 table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="50px">No.</th>
                        <th>Nama Ujian</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($mhs as $s): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $s['nama_ujian']; ?></td>
                            <td>
                                <a href="<?= base_url('kuesioner2/isi/') . $s['id_ujian']; ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-sticky-note"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <p>Tidak ada data ujian yang tersedia.</p>
<?php endif; ?>

<!-- Menggabungkan tabel antara s_kegiatan dengan saran_kuesioner2 dengan status NULL di saran_kuesioner2 -->