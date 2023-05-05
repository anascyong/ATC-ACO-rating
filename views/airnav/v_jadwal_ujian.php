<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">
			<div class="alert alert-info" style="margin-bottom: 0rem;">
				<u><i class="fas fa-info-circle"></i> PETUNJUK</u><br>
				<small>Klik di <b>Nama Kegiatan</b> Pada Tabel Untuk Melihat Daftar Peserta Ujian</small>
			</div>
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
						<td>Kegiatan</td>
						<td>Examiner</td>
						<td>Status</td>
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
				<table id="mytable_kegiatan" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<td width="20px">No</td>
							<td>Kegiatan</td>
							<td>Hari</td>
							<td>Tanggal</td>
							<td>Pukul</td>
							<td>Peserta Ujian</td>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
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
						<th>Kegiatan Ujian</th>
						<td class="v_kegiatan"></td>
					</tr>
				</table>
				<table id="mytable_peserta" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<td width="20px">No</td>
							<td>Nama</td>
							<td>No. Lisensi</td>
							<td>Airnav</td>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_asesor" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title title-tambah-asesor"></h5>
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
				<table id="mytable_asesor" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<td width="20px">No</td>
							<td>Nama</td>
							<td>Jabatan</td>
							<td>Instansi</td>
							<td>No. Surat Tugas</td>
							<td>Tgl. Tugas</td>
							<td>Surat Tugas</td>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>