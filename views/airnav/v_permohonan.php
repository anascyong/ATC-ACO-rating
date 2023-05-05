<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">
			<button type="button" class="btn btn-info btn-sm btn-icon-split" onclick="add_data()">
				<span class="icon text-white-50"><i class="fas fa-plus"></i></span>
				<span class="text">Tambah</span>
			</button>
		</h6>
	</div>
	<div class="card-body">
		<div class="alert alert-info font-weight-bold">
			<small>Klik di <b>Jumlah Peserta</b> pada tabel untuk melihat daftar peserta</small>
		</div>
		<select id="status" name="status" class="form-control">
			<option value="">-- Status --</option>
			<option value="0">Ditolak</option>
			<option value="1">Draft</option>
			<option value="2">Verifikasi</option>
			<option value="3">Diterima</option>
		</select>
		<hr>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">Aksi</td>
						<td width="20px">No</td>
						<td>No. Surat</td>
						<td>Tgl. Surat</td>
						<td>Perihal</td>
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
<div id="modal_form" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form">
					<input type="hidden" name="id_permohonan">
					<div class="form-group">
						<label>Nomor Surat <span class="red">*</span></label>
						<input type="text" name="no_surat" class="form-control" placeholder="Nomor Surat">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Surat <span class="red">*</span></label>
						<input type="text" name="tgl_surat" class="form-control tgl" placeholder="Tanggal Surat">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Perihal <span class="red">*</span></label>
						<textarea name="keterangan" class="form-control" placeholder="Perihal"></textarea>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Surat Permohonan <span class="red">*</span><br><small>(Format File : .pdf)</small></label>
						<input name="surat_permohonan" type="file" class="custom-file">
						<span class="help-block"></span>
					</div>
					<div class="card">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold">Peserta Yang Terdaftar Dalam Surat Permohonan &nbsp;&nbsp;&nbsp;</h6>
						</div>
						<div class="card-body">
							<!-- <div id="btnNewPeserta"></div>
							<div class="alert alert-info" id="add-info" style="margin-top: 5px;">
								<small>Klik tombol <b>Tambah</b> diatas untuk menambahkan peserta</small>
							</div> -->
							<div class="table-responsive">
								<table id="mytable_list_peserta" class="table table-bordered" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td width="20px">Pilih</td>
											<td width="20px">No</td>
											<td>Nama</td>
											<td>No. Lisensi</td>
											<td>Airnav</td>
											<!-- <td>Status</td>
											<td>Catatan</td> -->
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								<div class="form-group catatan">
									<hr>
									<label>Catatan Dari DNP</label>
									<textarea name="catatan" class="form-control" placeholder="Catatan" readonly="true"></textarea>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_new_peserta" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal-title-new-peserta"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form_new_peserta">
					<input type="hidden" name="id_user">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama <span class="red">*</span></label>
								<input type="text" name="nama_user" class="form-control" placeholder="Nama Peserta">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>No. Lisensi <span class="red">*</span></label>
								<input type="text" name="no_lisensi" class="form-control" placeholder="No. Lisensi">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Jenis Kelamin <span class="red">*</span></label>
								<select name="id_jk" class="form-control">
									<option value="">Pilih</option>
								</select>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Tempat Lahir <span class="red">*</span></label>
								<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Tanggal Lahir <span class="red">*</span></label>
								<input type="text" name="tanggal_lahir" class="form-control tgl" placeholder="Tanggal Lahir">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Kebangsaan <span class="red">*</span></label>
								<select name="id_negara" class="form-control">
									<option value="">Pilih</option>
								</select>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>No. Hp <span class="red">*</span></label>
								<input type="text" name="no_hp" class="form-control" placeholder="No. Hp">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Email <span class="red">*</span></label>
								<input type="text" name="email" class="form-control" placeholder="Email">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Username <span class="red">*</span></label>
								<input type="text" name="username" class="form-control" placeholder="Username">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Password <span class="red">*</span></label>
								<input type="password" name="password" class="form-control" placeholder="Password">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Ulangi Password <span class="red">*</span></label>
								<input type="password" name="ulangi_password" class="form-control" placeholder="Ulangi Password">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Foto <span class="red">*</span><br><small>(Format File : jpg, png, pdf)</small></label>
								<input name="foto" type="file" class="custom-file">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>KTP <span class="red">*</span><br><small>(Format File : jpg, png, pdf)</small></label>
								<input name="ktp" type="file" class="custom-file">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Ijazah <span class="red">*</span><br><small>(Format File : jpg, png, pdf)</small></label>
								<input name="ijazah" type="file" class="custom-file">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSaveNewPeserta" onclick="save_new_peserta()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
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
				<div id="btnAddPeserta"></div>
				<hr>
				<div class="alert alert-info font-weight-bold">
					<small>Klik tombol <b>Tambah</b> diatas untuk menambahkan peserta</small>
				</div>
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
				<div class="form-group catatan">
					<hr>
					<label>Catatan Dari DNP</label>
					<textarea name="catatan" class="form-control" placeholder="Catatan" readonly="true"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_list_peserta" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal-title-peserta"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<small>Pilih dengan cara mencentang pada daftar peserta kemudian klik tombol <b>Simpan</b> dibawah</small>
				</div>
				<form action="#" id="form_peserta">
					<input type="hidden" name="id_permohonan">
					<table id="mytable_tambah_peserta" class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td width="20px">Pilih</td>
								<td width="20px">No</td>
								<td>Nama</td>
								<td>No. Lisensi</td>
								<td>Airnav</td>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSavePeserta" onclick="save_peserta()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>