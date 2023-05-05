<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">
		</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">No</td>
						<td>Nama Jadwal</td>
						<td>Airnav</td>
						<td>Kegiatan Pengujian</td>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<div id="modal_kegiatan" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<tr>
						<th>Nomor Surat</th>
						<td class="v_no_surat"></td>
					</tr>
					<tr>
						<th>Nama Jadwal</th>
						<td class="v_keterangan"></td>
					</tr>
					<tr>
						<th>Airnav</th>
						<td class="v_nama_lokasi"></td>
					</tr>
				</table>
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<table id="mytable_kegiatan_teori" class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td width="20px">No</td>
								<td>Kegiatan</td>
								<td>Hari</td>
								<td>Tanggal</td>
								<td>Pukul</td>
								<td>Nilai</td>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_peserta" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title title-tambah-peserta"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form" action="#">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>Nomor Surat</th>
								<td class="v_no_surat"></td>
							</tr>
							<tr>
								<th>Nama Jadwal</th>
								<td class="v_keterangan"></td>
							</tr>
							<tr>
								<th>Airnav</th>
								<td class="v_nama_lokasi"></td>
							</tr>
							<tr>
								<th>Kegiatan</th>
								<td class="v_kegiatan"></td>
							</tr>
						</table>
						<table id="mytable_peserta" class="table table-bordered" width="100%" cellspacing="0">
							<thead>
								<tr>
									<td width="20px">No</td>
									<td>Nama</td>
									<td>No. Lisensi</td>
									<td>Nilai Teori</td>
									<td>Nilai Essay</td>
									<!-- <td>Nilai Re-check Teori</td> -->
									<td>Nilai Wawancara</td>
									<!-- <td>Nilai Re-check Wawancara</td> -->
									<td>Keterangan</td>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>