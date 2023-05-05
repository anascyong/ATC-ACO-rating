<li id="navItemDashboard" class="nav-item">
	<a class="nav-link" href="<?php echo base_url(); ?>">
		<i class="fas fa-fw fa-home"></i>
		<span>Dashboard</span>
	</a>
</li>
<!-- <hr class="sidebar-divider">
<li id="navItemLokasi" class="nav-item">
	<a class="nav-link" href="<?php echo base_url('lokasi'); ?>">
		<i class="fas fa-fw fa-building"></i>
		<span>Airnav</span>
	</a>
</li> -->
<hr class="sidebar-divider">
<li id="navItemPermohonan" class="nav-item">
	<a class="nav-link" href="<?php echo base_url('permohonan/ujian'); ?>">
		<i class="fas fa-fw fa-file-alt"></i>
		<span>Permohonan Assessment</span>
	</a>
</li>
<hr class="sidebar-divider">
<li id="navItemJadwalUjian" class="nav-item">
	<a class="nav-link" href="<?php echo base_url('jadwal/ujian'); ?>">
		<i class="fas fa-fw fa-calendar-alt"></i>
		<span>Jadwal Assessment</span>
	</a>
</li>
<hr class="sidebar-divider">
<li id="navItemPelaksanaanUjian" class="nav-item">
	<a class="nav-link" href="<?php echo base_url('pelaksanaan/ujian'); ?>">
		<i class="fas fa-fw fa-pencil-alt"></i>
		<span>Pelaksanaan & Hasil Assessment</span>
	</a>
</li>
<hr class="sidebar-divider">
<li id="navItemBeritaAcara" class="nav-item">
	<a class="nav-link" href="<?php echo base_url('berita/acara'); ?>">
		<i class="fas fa-fw fa-clipboard"></i>
		<span>Berita Acara</span>
	</a>
</li>
<hr class="sidebar-divider">
<li id="navItemSKChecker" class="nav-item">
	<a class="nav-link" href="<?php echo base_url('sk/checker'); ?>">
		<i class="fas fa-fw fa-file-alt"></i>
		<span>SK Checker</span>
	</a>
</li>
<hr class="sidebar-divider">
<li id="navItemManajemenUser" class="nav-item">
	<a class="nav-link" href="<?php echo base_url('manajemen/user'); ?>">
		<i class="fas fa-fw fa-user"></i>
		<span>Manajemen User</span>
	</a>
</li>
<hr class="sidebar-divider">
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
	aria-expanded="true" aria-controls="collapseMasterData"><i class="fas fa-fw fa-chart-pie"></i><span>Master Data</span></a>
	<div id="collapseMasterData" class="collapse" aria-labelledby="headingMasterData" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<a id="collapseLokasi" class="collapse-item" href="<?php echo base_url('lokasi'); ?>">
				Airnav
			</a>
			<!-- <a id="collapseJenis" class="collapse-item" href="<?php echo base_url('jenis'); ?>">
				Jenis Pengetahuan
			</a>
			<a id="collapseKelompok" class="collapse-item" href="<?php echo base_url('kelompok'); ?>">
				Kelompok Soal
			</a> -->
			<a id="collapseSoal" class="collapse-item" href="<?php echo base_url('soal'); ?>">
				Bank Soal
			</a>
		</div>
	</div>
</li>