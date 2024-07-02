<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?=base_url()?>assets/dist/img/user1.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?=$user->username?></p>
				<small><?=$user->email?></small>
			</div>
		</div>
		
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN MENU</li>
			<!-- Optionally, you can add icons to the links -->
			<?php 
			$page = $this->uri->segment(1);
			$master = ["jurusan", "kelas", "matkul", "dosen", "mahasiswa"];
			$relasi = ["kelasdosen", "jurusanmatkul"];
			$users = ["users"];
			?>
			<li class="<?= $page === 'dashboard' ? "active" : "" ?>"><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			<?php if($this->ion_auth->is_admin()) : ?>
			<li class="treeview <?= in_array($page, $master)  ? "active menu-open" : ""  ?>">
				<a href="#"><i class="fa fa-folder"></i> <span>Data Master</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?=$page==='jurusan'?"active":""?>">
						<a href="<?=base_url('jurusan')?>">
							<i class="fa fa-circle-o"></i> 
							Master Tipe Pegawai
						</a>
					</li>
					<li class="<?=$page==='kelas'?"active":""?>">
						<a href="<?=base_url('kelas')?>">
							<i class="fa fa-circle-o"></i>
							Master Departemen
						</a>
					</li>
					<li class="<?=$page==='matkul'?"active":""?>">
						<a href="<?=base_url('matkul')?>">
							<i class="fa fa-circle-o"></i>
							Master Organisasi Unit
						</a>
					</li>
					<li class="<?=$page==='dosen'?"active":""?>">
						<a href="<?=base_url('dosen')?>">
							<i class="fa fa-circle-o"></i>
							Master Atasan
						</a>
					</li>
					<li class="<?=$page==='mahasiswa'?"active":""?>">
						<a href="<?=base_url('mahasiswa')?>">
							<i class="fa fa-circle-o"></i>
							Master Peserta
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview <?= in_array($page, $relasi)  ? "active menu-open" : ""  ?>">
				<a href="#"><i class="fa fa-link"></i> <span>Relasi</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?=$page==='kelasdosen'?"active":""?>">
						<a href="<?=base_url('kelasdosen')?>">
							<i class="fa fa-circle-o"></i>
							Departemen - Atasan
						</a>
					</li>
					<li class="<?=$page==='jurusanmatkul'?"active":""?>">
						<a href="<?=base_url('jurusanmatkul')?>">
							<i class="fa fa-circle-o"></i>
							Tipe Pegawai - Organisasi Unit
						</a>
					</li>
				</ul>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen') ) : ?>
			<li class="<?=$page==='soal'?"active":""?>">
				<a href="<?=base_url('soal')?>" rel="noopener noreferrer">
					<i class="fa fa-file-text-o"></i> <span>Bank Soal</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen') ) : ?>
			<li class="<?=$page==='belajar'?"active":""?>">
				<a href="<?=base_url('belajar/data')?>" rel="noopener noreferrer">
					<i class="fa fa-file-text-o"></i> <span>Video Pembelajaran</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen') ) : ?>
			<li class="<?=$page==='ujian'?"active":""?>">
				<a href="<?=base_url('ujian/master')?>" rel="noopener noreferrer">
					<i class="fa fa-chrome"></i> <span>Ujian</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->in_group('mahasiswa') ) : ?>
			<li class="<?=$page==='ujian'?"active":""?>">
				<a href="<?=base_url('ujian/lizt')?>" rel="noopener noreferrer">
					<i class="fa fa-chrome"></i> <span>Ujian</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->in_group('mahasiswa') ) : ?>
			<li class="<?=$page==='Belajar'?"active":""?>">
				<a href="<?=base_url('Belajar')?>" rel="noopener noreferrer">
				<i class="fa fa-book"></i><span>Belajar</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->in_group('mahasiswa') ) : ?>
			<li class="<?=$page==='kuesioner'?"active":""?>">
				<a href="<?=base_url('kuesioner/listkuesioner')?>" rel="noopener noreferrer">
				<i class="fa fa-list-ol"></i><span>Kuesioner</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->in_group('mahasiswa') ) : ?>
			<li class="<?=$page==='kuesioner2'?"active":""?>">
				<a href="<?=base_url('kuesioner2/listkuesioner')?>" rel="noopener noreferrer">
				<i class="fa fa-list-ol"></i><span>Kuesioner Lv2</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( !$this->ion_auth->in_group('mahasiswa') ) : ?>
			<li class="header">REPORTS</li>
			<li class="<?=$page==='hasilujian'?"active":""?>">
				<a href="<?=base_url('hasilujian')?>" rel="noopener noreferrer">
					<i class="fa fa-file"></i> <span>Hasil Ujian</span>
				</a>
			</li>
				<?php if($this->ion_auth->is_admin()) : ?>
				<li class="<?=$page==='kuesioner'?"active":""?>">
					<a href="<?=base_url('kuesioner')?>" rel="noopener noreferrer">
						<i class="fa fa-list-ol"></i> <span>Kuesioner</span>
					</a>
				</li>
				<?php endif; ?>
				<?php if($this->ion_auth->is_admin()) : ?>
        <li class="<?=$page==='kuesioner2'?"active":""?>">
            <a href="<?=base_url('kuesioner2')?>" rel="noopener noreferrer">
                <i class="fa fa-list-ol"></i> <span>Kuesioner Lv2</span>
            </a>
        </li>
    <?php endif; ?>
			<?php endif; ?>
			<?php if($this->ion_auth->is_admin()) : ?>
			<li class="header">ADMINISTRATOR</li>
			<li class="<?=$page==='users'?"active":""?>">
				<a href="<?=base_url('users')?>" rel="noopener noreferrer">
					<i class="fa fa-users"></i> <span>User Management</span>
				</a>
			</li>
			<li class="<?=$page==='settings'?"active":""?>">
				<a href="<?=base_url('settings')?>" rel="noopener noreferrer">
					<i class="fa fa-cog"></i> <span>Settings</span>
				</a>
			</li>
			<?php endif; ?>
		</ul>

	</section>
	<!-- /.sidebar -->
</aside>