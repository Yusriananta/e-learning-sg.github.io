<?php if( $this->ion_auth->is_admin() ) : ?>
<div class="row">
    <?php foreach($info_box as $info): ?>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-<?= $info->box ?>">
                <div class="inner">
                    <h3><?= $info->total ?></h3>
                    <p><?= $info->title ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-<?= $info->icon ?>"></i>
                </div>
                <a href="<?= base_url($info->url) ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php elseif( $this->ion_auth->in_group('dosen') ) : ?>

<div class="row">
    <div class="col-sm-4">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Akun</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>Nama</th>
                    <td><?=$dosen->nama_dosen?></td>
                </tr>
                <tr>
                    <th>Nomor Pegawai</th>
                    <td><?=$dosen->nip?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$dosen->email?></td>
                </tr>
                <tr>
                    <th>Organisasi Unit</th>
                    <td><?=$dosen->nama_matkul?></td>
                </tr>
                <tr>
                    <th>Departemen</th>
                    <td>
                        <ol class="pl-4">
                        <?php foreach ($kelas as $k) : ?>
                            <li><?=$k->nama_kelas?></li>
                        <?php endforeach;?>
                        </ol>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="box box-solid">
            <div class="box-header bg-purple">
                <h3 class="box-title">Pemberitahuan</h3>
            </div>
            <div class="box-body">
                <p>Selamat datang di platform Digital Library Berikut adalah panduan singkat sebagai atasan untuk membantu memaksimalkan pengalaman belajar para karyawan:</p>
                <ul class="pl-4">
                    <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, culpa.</li>
                    <li>Provident dolores doloribus, fugit aperiam alias tempora saepe non omnis.</li>
                    <li>Doloribus sed eum et repellat distinctio a repudiandae quia voluptates.</li>
                    <li>Adipisci hic rerum illum odit possimus voluptatibus ad aliquid consequatur.</li>
                    <li>Laudantium sapiente architecto excepturi beatae est minus, labore non libero.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php else : ?>

<div class="row">
    <div class="col-sm-4">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Akun</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>Nomor Pegawai</th>
                    <td><?=$mahasiswa->nim?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?=$mahasiswa->nama?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?=$mahasiswa->jenis_kelamin === 'L' ? "Laki-laki" : "Perempuan" ;?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$mahasiswa->email?></td>
                </tr>
                <tr>
                    <th>Tipe Pegawai</th>
                    <td><?=$mahasiswa->nama_jurusan?></td>
                </tr>
                <tr>
                    <th>Departemen</th>
                    <td><?=$mahasiswa->nama_kelas?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="box box-solid">
            <div class="box-header bg-purple">
                <h3 class="box-title">Pemberitahuan</h3>
            </div>
            <div class="box-body">
                <p>Selamat datang di platform Digital Library Berikut adalah panduan singkat untuk membantu Anda memulai dan memaksimalkan pengalaman belajar Anda:</p>
                <ul class="pl-4">
                    <li>Masuk menggunakan email SIG dan password NIK 4 digit terakhir.</li>
                    <li>Untuk mengerjakan soal bisa diakses di bagian Ujian.</li>
                    <li>Dihalaman kuesioner 1 dan 2, pertanyaan kuesioner akan muncul jika pengguna selesai mengerjakan ujian.</li>
                    <li>Adipisci hic rerum illum odit possimus voluptatibus ad aliquid consequatur.</li>
                    <li>Kuesioner 2 dapat diakses jika pengguna selesai mengerjakan kuesioner 1.</li>
                    <li>Untuk materi video pembelajaran bisa akses dihalaman belajar</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>