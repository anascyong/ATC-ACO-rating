<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="col-md-6">
				<select id="id_lokasi" name="id_lokasi" class="form-control"></select>
			</div>
			<div class="col-md-6">
				<select id="status" name="status" class="form-control">
					<option value="">-- Status --</option>
					<option value="2">Verifikasi</option>
					<option value="3">Diterima</option>
				</select>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">Aksi</td>
						<td width="20px">No</td>
						<td>No. Surat</td>
						<td>Tgl. Surat</td>
						<td>Perihal</td>
						<td>Airnav</td>
						<td>Surat Permohonan</td>
						<td>Peserta</td>
						<td>Status</td>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<div id="modal_peserta" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
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
						<th>Tanggal Surat</th>
						<td class="v_tgl_surat"></td>
					</tr>
					<tr>
						<th>Airnav</th>
						<td class="v_nama_lokasi"></td>
					</tr>
					<tr>
						<th>Perihal</th>
						<td class="v_keterangan"></td>
					</tr>
					<tr>
						<th>Surat Permohonan</th>
						<td class="v_surat_permohonan"></td>
					</tr>
				</table>
				<div class="table-responsive">
					<table id="mytable_peserta" class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td width="20px">Aksi</td>
								<td width="20px">No</td>
								<td>Nama</td>
								<td>No. Lisensi</td>
								<td>Airnav</td>
								<td>Status</td>
								<td>Catatan</td>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_verifikasi" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form" action="#">
					<input type="hidden" name="id_permohonan">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>Nomor Surat</th>
								<td class="v_no_surat"></td>
							</tr>
							<tr>
								<th>Tanggal Surat</th>
								<td class="v_tgl_surat"></td>
							</tr>
							<tr>
								<th>Airnav</th>
								<td class="v_nama_lokasi"></td>
							</tr>
							<tr>
								<th>Perihal</th>
								<td class="v_keterangan"></td>
							</tr>
							<tr>
								<th>Surat Permohonan</th>
								<td class="v_surat_permohonan"></td>
							</tr>
						</table>
						<table id="mytable_verifikasi_peserta" class="table table-bordered" width="100%" cellspacing="0">
							<thead>
								<tr>
									<td width="20px">Aksi</td>
									<td width="20px">No</td>
									<td>Nama</td>
									<td>No. Lisensi</td>
									<td>Airnav</td>
									<td>Status</td>
									<td>Catatan</td>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<div class="form-group">
						<hr>
						<label>Catatan</label>
						<textarea name="catatan" class="form-control" placeholder="Catatan"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnTerima" onclick="terima()" class="btn btn-success"><i class="fas fa-check"></i> Terima</button>
				<button type="button" id="btnTolak" onclick="tolak()" class="btn btn-danger"><i class="fas fa-times"></i> Tolak</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_verifikasi_peserta" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title title-verifikasi-peserta"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_peserta" action="#">
					<input type="hidden" name="id">
					<table class="table table-bordered">
						<tr>
							<th>Nomor Surat</th>
							<td class="v_no_surat"></td>
						</tr>
						<tr>
							<th>Tanggal Surat</th>
							<td class="v_tgl_surat"></td>
						</tr>
						<tr>
							<th>Airnav</th>
							<td class="v_nama_lokasi"></td>
						</tr>
						<tr>
							<th>Perihal</th>
							<td class="v_keterangan"></td>
						</tr>
						<tr>
							<th>Surat Permohonan</th>
							<td class="v_surat_permohonan"></td>
						</tr>
					</table>
					<div class="card">
						<div class="card-header">Informasi Peserta</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<th>Nama</th>
										<td class="v_nama_user"></td>
									</tr>
									<tr>
										<th>No. Lisensi</th>
										<td class="v_no_lisensi"></td>
									</tr>
									<tr>
										<th>Bidang</th>
										<td class="v_bidang_pelatihan"></td>
									</tr>
									<tr>
										<th>Jenis Kelamin</th>
										<td class="v_jenis_kelamin"></td>
									</tr>
									<tr>
										<th>Tempat Lahir</th>
										<td class="v_tempat_lahir"></td>
									</tr>
									<tr>
										<th>Tanggal Lahir</th>
										<td class="v_tanggal_lahir"></td>
									</tr>
									<tr>
										<th>Alamat</th>
										<td class="v_alamat"></td>
									</tr>
									<tr>
										<th>No. Hp</th>
										<td class="v_no_hp"></td>
									</tr>
									<tr>
										<th>Email</th>
										<td class="v_email"></td>
									</tr>
									<tr>
										<th>Lisensi</th>
										<td class="v_lisensi_file"></td>
									</tr>
									<tr>
										<th>Rating</th>
										<td class="v_rating_file"></td>
									</tr>
									<tr>
										<th>Sertifikat Kesehatan (Minimal Kelas 3)</th>
										<td class="v_medex_file"></td>
									</tr>
									<tr>
										<th>Sertifikat ICAO IELP (Minimal Level 4)</th>
										<td class="v_ielp_file"></td>
									</tr>
									<tr>
										<th>Sertifikat Kompetensi</th>
										<td class="v_kompetensi_file"></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="form-group">
						<hr>
						<label>Catatan</label>
						<textarea name="catatan_peserta" class="form-control" placeholder="Catatan"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnLengkap" onclick="lengkap()" class="btn btn-success"><i class="fas fa-check"></i> Lengkap</button>
				<button type="button" id="btnTidakLengkap" onclick="tidak_lengkap()" class="btn btn-danger"><i class="fas fa-times"></i> Tidak Lengkap</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>