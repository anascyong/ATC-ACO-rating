<div class="row">
	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
							Jadwal Assessment
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php
							$notif = $this->db->get_where('m_jadwal_assessment2', array(
								'status_jadwal' => 1,
							));
							echo $notif->num_rows();
							?>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-bookmark fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							Pelaksanaan & Hasil Assessment
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php
							$notif = $this->db->get_where('m_jadwal_assessment2', array(
								'status_jadwal' => 1,
							));
							echo $notif->num_rows();
							?>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-bookmark fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>