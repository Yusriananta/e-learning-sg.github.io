<?php echo $this->session->flashdata('message');?>
<div class="box box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title">
            Isi Kuesioner Dibawah ini
        </h3> 
    </div>
    <div class="box-body">
        
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Pertanyaan</th>
              <th class="text-center" width="150px">Sangat Baik</th>
              <th class="text-center" width="150px">Baik</th>
              <th class="text-center" width="150px">B ajah</th>
              <th class="text-center" width="150px">kureng bet</th>
            </tr>
          </thead>
          <tbody>
            
          <?php $i = 1; foreach ($pertanyaan as $soal) { ?>
            
            <tr>
              <th scope="row"><?= $i ?></th>
              <td><?php echo $soal['pertanyaan'];?></td>
              <form class="ml-2" action="<?php echo site_url('kuesioner2/aksiKegiatan');?>" method="post" novalidate="novalidate">
              <td class="text-center"><input type="radio" id="exampleCustomRadio1<?=$i?>" name="opsi[<?=$i?>]" value="4" class="custom-control-input" required></td>
              <td class="text-center"><input type="radio" id="exampleCustomRadio1<?=$i?>" name="opsi[<?=$i?>]" value="3" class="custom-control-input" required></td>
              <td class="text-center"><input type="radio" id="exampleCustomRadio1<?=$i?>" name="opsi[<?=$i?>]" value="2" class="custom-control-input" required></td>
              <td class="text-center"><input type="radio" id="exampleCustomRadio1<?=$i?>" name="opsi[<?=$i?>]" value="1" class="custom-control-input" required></td>
              <input type="hidden" id="id_ujian" name="id_ujian" value="<?php echo $soal['id_ujian'];?>">
            </tr> 
        <?php $i++;} ?> 
          </tbody>
        </table>
        <label for="deskripsi" class="col-sm-4 mt-5 col-form-label">Saran</label>
        <textarea type="text" class="col-sm-4 form-control" id="saran" name="saran" require></textarea>  
        <button type="submit" class="btn btn-primary mt-5">Submit</button>
            </form>
    </div>
</div>
