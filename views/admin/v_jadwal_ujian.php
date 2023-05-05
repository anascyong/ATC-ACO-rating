<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info">
			<button type="button" class="btn btn-info btn-sm btn-icon-split" onclick="add_data()">
				<span class="icon text-white-50"><i class="fas fa-plus"></i></span>
				<span class="text">Tambah</span>
			</button>
		</h6>
	</div>
	<div class="card-body">
		<div class="alert alert-info">
			<small>Klik <b>Detail Kegiatan</b> untuk melihat detail kegiatan dari jadwal</small>
		</div>
		<div class="row">
			<div class="col-md-6">
				<select id="f_id_lokasi" name="f_id_lokasi" class="form-control"></select>
			</div>
			<div class="col-md-6">
				<select id="f_status_jadwal" name="f_status_jadwal" class="form-control">
					<option value="">-- Status --</option>
					<option value="1">Publish</option>
					<option value="0">Draft</option>
				</select>
			</div>
		</div>
		<hr>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">Aksi</td>
						<td width="20px">No</td>
						<td>Nama Ujian</td>
						<td>Airnav</td>
						<td>Kegiatan Pengujian</td>
						<td>Examiner</td>
						<td>Status</td>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<div id="modal_form" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form">
					<input type="hidden" name="id_jadwal_assessment">
					<div class="form-group">
						<label>Airnav <span class="red">*</span></label>
						<select id="id_lokasi" name="id_lokasi" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>No. Surat <span class="red">*</span></label>
						<select id="id_permohonan" name="id_permohonan" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Status <span class="red">*</span></label>
						<select name="status_jadwal" class="form-control">
							<option value="1">Publish</option>
							<option value="0">Draft</option>
						</select>
						<span class="help-block"></span>
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
				<div id="btnAddKegiatan"></div>
				<hr>
				<div class="alert alert-info">
					<small>Klik tombol <b>Tambah</b> diatas untuk menambahkan detail kegiatan ujian pada jadwal</small>
				</div>
				<table id="mytable_kegiatan" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<td width="20px">Aksi</td>
							<td width="20px">No</td>
							<td>Kegiatan Ujian</td>
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
<div id="modal_form_kegiatan" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title title-tambah-kegiatan"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form_kegiatan">
					<input type="hidden" name="id_kegiatan_assessment">
					<input type="hidden" name="id_jadwal_assessment">
					<div class="form-group">
						<label>Kegiatan Ujian <span class="red">*</span></label>
						<input type="text" name="kegiatan" class="form-control" placeholder="Kegiatan Ujian">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Kategori Ujian <span class="red">*</span></label>
						<select name="id_kategori" class="form-control">
							<option value="1">Teori</option>
							<option value="2">Recheck Teori</option>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal <span class="red">*</span></label>
						<input type="text" name="tanggal" class="form-control tgl" placeholder="Tanggal">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Dari Pukul <span class="red">*</span></label>
						<input type="time" name="dari_pukul" class="form-control" placeholder="Dari Pukul">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Sampai Pukul <span class="red">*</span></label>
						<input type="time" name="sampai_pukul" class="form-control" placeholder="Sampai Pukul">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<select name="waktu" class="form-control">
							<option value="WIB">WIB</option>
							<option value="WIT">WIT</option>
							<option value="WITA">WITA</option>
							<span class="help-block"></span>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSaveKegiatan" onclick="save_kegiatan()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
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
				<div id="btnAddPeserta"></div>
				<hr>
				<div class="alert alert-info">
					<small>Klik tombol <b>Tambah</b> diatas untuk menambahkan peserta ujian</small>
				</div>
				<table id="mytable_peserta" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<td width="20px">Aksi</td>
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
<div id="modal_form_peserta" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal-title-peserta"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="btnAddNewPeserta"></div><br>
				<div class="alert alert-info">
					<small>Pilih dengan cara mencentang pada daftar peserta kemudian klik tombol <b>Simpan</b> dibawah</small>
				</div>
				<form action="#" id="form_peserta">
					<input type="hidden" name="id_kegiatan_assessment">
					<table id="mytable_list_peserta" class="table table-bordered" width="100%" cellspacing="0">
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
					<input type="hidden" name="id_lokasi">
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
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>No. Hp <span class="red">*</span></label>
								<input type="text" name="no_hp" class="form-control" placeholder="No. Hp">
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
				<div id="btnAddAsesor"></div>
				<hr>
				<div class="alert alert-info">
					<small>Klik tombol <b>Tambah</b> diatas untuk menambahkan asesor</small>
				</div>
				<table id="mytable_asesor" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<td width="20px">Aksi</td>
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
<div id="modal_form_asesor" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal-title-asesor"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form_asesor">
					<input type="hidden" name="id_jadwal_assessment">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>No. Surat Tugas</label>
								<input type="text" name="no_surat_tugas" class="form-control" placeholder="No. Surat Tugas">
								<span class="help-block"></span>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Dari Tanggal</label>
										<input type="text" name="tgl_mulai" class="form-control tgl" placeholder="Dari Tanggal">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Sampai Tanggal</label>
										<input type="text" name="tgl_selesai" class="form-control tgl" placeholder="Sampai Tanggal">
										<span class="help-block"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Surat Tugas<br><small>(Format File : pdf, jpg, png)</small></label>
								<input type="file" name="file_surat_tugas" class="custome-file">
								<span class="help-block"></span><br>
							</div>
						</div>
					</div>
					<div class="alert alert-info">
						<small>Pilih dengan cara mencentang pada daftar asesor kemudian klik tombol <b>Simpan</b> dibawah</small>
					</div>
					<table id="mytable_list_asesor" class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td width="20px">Pilih</td>
								<!-- <td width="20px">Ketua</td> -->
								<td width="20px">No</td>
								<td>Nama</td>
								<td>Jabatan</td>
								<td>Instansi</td>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSaveAsesor" onclick="save_asesor()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>