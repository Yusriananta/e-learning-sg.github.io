<?php echo $this->session->flashdata('message');?>

<div class="callout callout-info">
    <h4>Hasil Ujian</h4>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.  nemo 
        iste cum sunt debitis odio beatae placeat nemo..</p>

</div>

<div class="row">
    <!-- <div class="col-sm-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Nilai Ujian</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body text-center" id="tampil_jawaban">
              <h1>Test 90</h1>
          </div>
        </div>
    </div> -->

    
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><span class="badge bg-blue">Soal <span id="soalke"></span> </span></h3>

        </div>
        <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                        <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-refresh"></i> Reload</button>
                    </div>
                </div>
        </div>

        <div class="box-body">
            <div class="table-responsive px-4 pb-3" style="border: 0">
                <table id="ujian" class="w-100 table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Soal</th>
                        <th>Jawaban</th>
						<th>Status</th>
                        <!-- <th class="text-center">Aksi</th> -->
                    </tr>        
                </thead>
                <tbody>
                  <?php $no=1; foreach ($hasil as $s):?>
                    <tr>
                      <td><?= $no++;?></td>
                      <td><?= $s['soal'];?></td>
                      <td><?= $s['description']?></td>
                      <td>
                          <?php 
                          // Bandingkan jawaban peserta dengan kunci jawaban
                          if ($s['list_jawaban'] == $s['kunci_jawaban']) {
                            echo "<span class='badge bg-green'> Benar </span>";
                          } else {
                              echo "<span class='badge bg-red'> Salah </span>";
                          }
                          ?>
                      </td>
                    </tr>
                  <?php endforeach;?>
                </tbody>

                </table>
            </div>
        </div>

          <div class="box-body">
                <div class="pull-right">
                    <div class="col-sm-4">
                        <button class="selesai submit btn btn-danger" onclick="logujian()">Selesai</button>
                    </div>
                </div>
          </div>

      </div>
    </div>

</div>

<script>
    // tes script and github
  function logujian() {
            // Melakukan AJAX request ke server
            $.ajax({
                url: base_url + "ujian/logjawaban/",
                type: "POST", // Atau GET sesuai kebutuhan
                data: { action: "logujian" }, // Data yang ingin Anda kirim ke server
                success: function(response) {
                    console.log("Berhasil memanggil fungsi logujian.");
                    window.location.replace(base_url + "ujian/lizt");
                    // Lakukan lebih banyak pekerjaan di sini sesuai kebutuhan
                },
                error: function(xhr, status, error) {
                    console.error("Gagal memanggil fungsi logujian:", error);
                }
            });
        }
</script>