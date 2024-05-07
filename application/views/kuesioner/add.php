<div class="col mb-3">
    <?php echo $this->session->flashdata('message');?>
    <button class="btn btn-warning" data-toggle="modal" data-target="#addPertanyaan"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah Pertanyaan</button>
</div>

<div class="box box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title">
            Pertanyaan Kuesioner
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body"> 
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" width="50px">No</th>
              <th scope="col" width="250px">Kegiatan</th>
              <th scope="col">Pertanyaan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $no=1;?>
          <?php foreach ($pertanyaan as $key):?>
            <tr>
              <th><?php echo $no++;?></th>
              <th><?php echo $key['nama_ujian'];?></th>
              <td><?php echo $key['pertanyaan'];?></td>
              <td>
              <!-- <a href="" class="btn btn-xs btn-success" data-toggle="modal" data-target="#edit<?=$key['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
              <a href="<?php base_url();?>kuesioner/delete/<?php echo $key['id'];?>" class="btn btn-xs btn-danger" onclick="return confirm('Yakin ingin menghapus Pertanyaan?');"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <?php endforeach;?> 
          </tbody>
        </table>
    </div>
</div>


<div class="box box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title">
            Hasil Kuesioner
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body"> 
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" width="50px">No</th>
              <th scope="col" width="250px">Nama Kegiatan</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Penilaian</th>
              <th scope="col" width="150px">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $no=1;?>
          <?php foreach ($nilai as $key):?>
            <tr>
              <th><?php echo $no++;?></th>
              <td><?php echo $key['kegiatan'];?></td>
              <td>
                  <?php $date=date_create($key['tgl_mulai']); 
                  echo date_format($date,"j F Y, g:i a");
                  ?>
                   - 
                  <?php $date=date_create($key['tgl_akhir']); 
                  echo date_format($date,"j F Y, g:i a");
                  ?>
              </td>
              <td>

              <?php if ($key['nilai'] == 4):?>
                <span class="label label-primary">Baik Sekali</span>
              <?php endif;?>

              <?php if ($key['nilai'] == 3):?>
                <span class="label label-success">Baik</span>
              <?php endif;?>

              <?php if ($key['nilai'] == 2):?>
                <span class="label label-warning">B ajah</span>
              <?php endif;?>

              <?php if ($key['nilai'] == 1):?>
                <span class="label label-danger">Kureng Bet</span>
              <?php endif;?>

              <?php if (!$key['nilai']):?>
                <span class="label label-info">Belum ada penilaian</span>
              <?php endif;?>
               
              </td>
              <td>
              <a href="<?php base_url();?>kuesioner/kegiatanDetail/<?php echo $key['id_ujian'];?>" class="btn btn-xs btn-info"><i class="fa fa-info-circle"></i> Detail & saran</a>
              </td>
            <?php endforeach;?>
            </tr>
          </tbody>
        </table>
    </div>
</div>




<!-- Modal Tambah Pertanyaan -->
<div class="modal fade" id="addPertanyaan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addPertanyaanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPertanyaanLabel">Tambah Pertanyaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="<?php echo base_url('kuesioner');?>" method="post">
           <div class="form-group">
            <label for="pertanyaan">Kegiatan</label>
            <select class="form-control" id="kegiatan" name="kegiatan" required>
              <option value="">Pilih Kegiatan</option>
              <?php foreach ($kegiatan as $key):?>
              <option value="<?php echo $key['id_ujian'];?>"><?php echo $key['nama_ujian'];?></option>
              <?php endforeach;?>
            </select> 
          </div>

           <div class="form-group">
            <label for="pertanyaan">Pertanyaan</label>
            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" placeholder="Tulis pertanyaan" required> 
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit Pertanyaan -->
<?php foreach ($pertanyaan as $key):?>
<div class="modal fade" id="edit<?php echo $key['id'];?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editPertanyaanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPertanyaanLabel">Edit Pertanyaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form>
            <div class="form-group">
            <label for="exampleInputEmail1">Id</label>
            <input type="text" class="form-control" id="pertanyaan" value="<?php echo $key['id'];?>" required>
          </div>

           <div class="form-group">
            <label for="exampleInputEmail1">Pertanyaan</label>
            <input type="text" class="form-control" id="pertanyaan" value="<?php echo $key['pertanyaan'];?>" required>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Edit</button>
<?php endforeach;?>
        </form>
      </div>
    </div>
  </div>
</div>

