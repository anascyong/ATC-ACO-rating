<?php
	$notif = $this->db->get_where('m_permohonan_assessment', array(
		'id_lokasi' => $this->session->userdata('id_lokasi'),
		'status' => 0,
	));
?>
<li class="nav-item dropdown no-arrow mx-1">
	<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fas fa-bell fa-fw"></i>
		<span class="badge badge-danger badge-counter"><?php echo $notif->num_rows(); ?></span>
	</a>
	<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
		<h6 class="dropdown-header">
			Pemberitahuan
		</h6>
		<a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('permohonan/ujian'); ?>">
			<div class="mr-3">
				<div class="icon-circle bg-success">
					<i class="fas fa-file-alt text-white"></i>
				</div>
			</div>
			<div>
				<span class="font-weight-bold">Ada <b><?php echo $notif->num_rows(); ?></b> Permohonan Assessment Ditolak</span>
			</div>
		</a>
		<a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url('permohonan/ujian'); ?>">Lihat Pemberitahuan</a>
	</div>
</li>