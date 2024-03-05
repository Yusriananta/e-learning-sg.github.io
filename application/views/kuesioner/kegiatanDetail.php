        <div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $Sbaik['persen'];?>%</h3>
                <p>Sangat Baik</p>
                <?php echo $Sbaik['Sbaik'];?>/<?php echo $Sbaik['jumlah'];?>
              </div>
              <div class="icon">
                <i class="fa fa-smile-o"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-light-blue">
              <div class="inner">
                <h3><?php echo $baik['persen'];?>%</h3>
                <p>Baik</p>
                <?php echo $baik['baik'];?>/<?php echo $baik['jumlah'];?>
              </div>
              <div class="icon">
                <i class="fa fa-smile-o"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-olive">
              <div class="inner">
                <h3><?php echo $cukup['persen'];?>%</h3>

                <p>B Ajah</p>
                <?php echo $cukup['cukup'];?>/<?php echo $cukup['jumlah'];?>
              </div>
              <div class="icon">
                <i class="fa fa-meh-o"></i>
              </div>
            </div>
          </div>

            <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-yellow-active">
              <div class="inner">
                <h3><?php echo $kurang['persen'];?>%</h3>

                <p>Kureng Bet</p>
                <?php echo $kurang['kurang'];?>/<?php echo $kurang['jumlah'];?>
              </div>
              <div class="icon">
                <i class="fa fa-frown-o"></i>
              </div>
            </div>
          </div>
        </div>

           

         <div class="col-sm-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Saran untuk kegiatan <b><?php echo $kegiatan['nama_ujian'];?></b></h3>
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
                          <th scope="col" width="130px">Pers Number</th>
                          <th scope="col" width="150px">Tanggal</th>
                          <th scope="col">Saran</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $no=1;?>
                      <?php foreach ($saran as $key):?>
                        <tr>
                          <th><?php echo $no++;?></th>
                          <th><?php echo $key['pers_no'];?></th>
                          <th>
                              <?php $date=date_create($key['tanggal']); 
                              echo date_format($date,"d F Y");
                              ?>
                          </th>
                          <td><?php echo $key['saran'];?></td>
                        </tr>
                      <?php endforeach;?>
                      </tbody>
                    </table>
            </div>
            
        </div>
    </div>
</div>