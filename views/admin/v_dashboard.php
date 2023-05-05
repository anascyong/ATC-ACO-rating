<div class="row">
	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
							Permohonan Assessment
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php echo count($verifikasi); ?>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-bookmark fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							Jadwal Assessment Aktif
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php echo count($jadwal); ?>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-bookmark fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
							Jadwal Assessment Sedang Berlangsung
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php echo count($mulai); ?>
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
		<div class="card border-left-info shadow h-100">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-success">Jumlah Permohonan Assessment</h6>
			</div>
			<div class="card-body">
				<div id="chartdiv1"></div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-success">Jumlah Jadwal Assessment</h6>
			</div>
			<div class="card-body">
				<div id="chartdiv2"></div>
			</div>
		</div>
	</div>
</div>
<style>
	#chartdiv1, #chartdiv2 {
		width		: 100%;
		height		: 200px;
		font-size	: 11px;
	}
</style>