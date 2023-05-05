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
		<h6 class="m-0 font-weight-bold text-primary">
			<div class="alert alert-info">
				<u><i class="fas fa-info-circle"></i> PETUNJUK</u><br>
				<small>Anda dapat menambahkan peserta melalui tombol <b>Tambah</b> diatas dan untuk mengelola data peserta dapat dilakukan melalui tombol &nbsp;<i class="fas fa-list"></i>&nbsp; pada kolom aksi</small>
			</div>
		</h6>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">Aksi</td>
						<td width="20px">No</td>
						<td>Nama</td>
						<td>No. Lisensi</td>
						<td>Bidang</td>
						<td>No. Hp</td>
						<td>Email</td>
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
								<label>Bidang <span class="red">*</span></label>
								<select id="id_bidang" name="id_bidang" class="form-control"></select>
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
								<label>Lisensi</label><br>
								<div class="edt preview_lisensi"></div>
								<input name="lisensi_file" type="file">
								<p class="red"><span class="help-block"></span></p>
							</div>
							<div class="form-group">
								<label>Rating</label><br>
								<div class="edt preview_rating"></div>
								<input name="rating_file" type="file">
								<p class="red"><span class="help-block"></span></p>
							</div>
							<div class="form-group">
								<label>Sertifikat Kesehatan (Minimal Kelas 3)</label><br>
								<div class="edt preview_medex"></div>
								<input name="medex_file" type="file">
								<p class="red"><span class="help-block"></span></p>
							</div>
							<div class="form-group">
								<label>Sertifikat ICAO IELP (Minimal Level 4)</label><br>
								<div class="edt preview_ielp"></div>
								<input name="ielp_file" type="file">
								<p class="red"><span class="help-block"></span></p>
							</div>
							<div class="form-group">
								<label>Sertifikat Kompetensi</label><br>
								<div class="edt preview_kompetensi"></div>
								<input name="kompetensi_file" type="file">
								<p class="red"><span class="help-block"></span></p>
							</div>
							<div class="form-group">
								<label><small>NB : Format File .pdf, .jpg, .jpeg, .png</small></label>
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
					<!-- <div class="card">
						<div class="card-header">Syarat Administrasi</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label><h4>Lisensi</h4></label><br>
										<button type="button" class="btn btn-primary btn-sm" onclick="add_lisensi()"><i class="fas fa-plus"></i> Tambah</button>
										<div class="table-responsive">
											<table id="mytable_lisensi" class="table table-bordered" style="width: 100%;">
												<thead>
													<tr>
														<th>Aksi</th>
														<th>No</th>
														<th>No. Lisensi</th>
														<th>Jenis Lisensi</th>
														<th>Tgl. Terbit Lisensi</th>
														<th>Tgl. Berlaku Lisensi</th>
														<th>File Lisensi</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="form-group">
										<label><h4>Rating</h4></label><br>
										<button type="button" class="btn btn-primary btn-sm" onclick="add_rating()"><i class="fas fa-plus"></i> Tambah</button>
										<div class="table-responsive">
											<table id="mytable_rating" class="table table-bordered" style="width: 100%;">
												<thead>
													<tr>
														<th>Aksi</th>
														<th>No</th>
														<th>Jenis Rating</th>
														<th>Tgl. Terbit Rating</th>
														<th>Tgl. Berlaku Rating</th>
														<th>File Rating</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="form-group">
										<label><h4>Sertifikat Kesehatan (Minimal Kelas 3)</h4></label><br>
										<button type="button" class="btn btn-primary btn-sm" onclick="add_medex()"><i class="fas fa-plus"></i> Tambah</button>
										<div class="table-responsive">
											<table id="mytable_medex" class="table table-bordered" style="width: 100%;">
												<thead>
													<tr>
														<th>Aksi</th>
														<th>No</th>
														<th>No. Sertifikat</th>
														<th>Kelas</th>
														<th>Tgl. Dikeluarkan</th>
														<th>Tgl. Berlaku</th>
														<th>File Sertifikat</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="form-group">
										<label><h4>Sertifikat ICAO IELP (Minimal Level 4)</h4></label><br>
										<button type="button" class="btn btn-primary btn-sm" onclick="add_icao()"><i class="fas fa-plus"></i> Tambah</button>
										<div class="table-responsive">
											<table id="mytable_icao" class="table table-bordered" style="width: 100%;">
												<thead>
													<tr>
														<th>Aksi</th>
														<th>No</th>
														<th>No. Sertifikat</th>
														<th>Level</th>
														<th>Tgl. Dikeluarkan</th>
														<th>Tgl. Berlaku</th>
														<th>File Sertifikat</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="form-group">
										<label><h4>Sertifikat Kompetensi</h4></label>
										<div class="table-responsive">
											<table id="mytable_serkom" class="table table-bordered" style="width: 100%;">
												<thead>
													<tr>
														<th>No</th>
														<th>Bidang</th>
														<th>Nama Sertifikat Kompetensi</th>
														<th>Upload</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="form-group">
										<label><h4>Sertifikat Pelatihan</h4></label>
										<div class="table-responsive">
											<table id="mytable_serpel" class="table table-bordered" style="width: 100%;">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Sertifikat Pelatihan</th>
														<th>Upload</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="form-group">
										<label>Pengalaman Masa Kerja</label>
										<select name="pengalaman" class="form-control">
											<option value="">-- Pilih --</option>
											<option value="">Lebih Dari 3 Tahun</option>
											<option value="">Kurang Dari 3 Tahun</option>
										</select>
									</div>
									<div class="form-group">
										<label>Sudah Pernah Menjadi Checker ?</label>
										<select id="menjadi" name="menjadi" class="form-control">
											<option value="">-- Pilih --</option>
											<option value="1">Belum</option>
											<option value="2">Sudah</option>
										</select>
									</div>
									<div class="form-group sk" style="display: none;">
										<label>Upload SK Checker</label>
										<input type="file" name="sk_checker" class="custom-file">
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_view" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<td>Airnav</td>
							<td class="v_nama_lokasi"></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td class="v_nama_user"></td>
						</tr>
						<tr>
							<td>No. Lisensi</td>
							<td class="v_no_lisensi"></td>
						</tr>
						<tr>
							<td>Bidang</td>
							<td class="v_bidang_pelatihan"></td>
						</tr>
						<tr>
							<td>TTL</td>
							<td class="v_ttl"></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td class="v_jenis_kelamin"></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td class="v_alamat"></td>
						</tr>
						<tr>
							<td>No. Hp</td>
							<td class="v_hp"></td>
						</tr>
						<tr>
							<td>Email</td>
							<td class="v_email"></td>
						</tr>
						<tr>
							<td>Username</td>
							<td class="v_username"></td>
						</tr>
						<tr>
							<td>Lisensi</td>
							<td class="v_lisensi_file"></td>
						</tr>
						<tr>
							<td>Rating</td>
							<td class="v_rating_file"></td>
						</tr>
						<tr>
							<td>Sertifikat Kesehatan (Minimal Kelas 3)</td>
							<td class="v_medex_file"></td>
						</tr>
						<tr>
							<td>Sertifikat ICAO IELP (Minimal Level 4)</td>
							<td class="v_ielp_file"></td>
						</tr>
						<tr>
							<td>Sertifikat Kompetensi</td>
							<td class="v_kompetensi_file"></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_form_lisensi" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal-title-lisensi"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form_lisensi">
					<input type="hidden" name="id">
					<div class="form-group">
						<label>Jenis Lisensi <span class="red">*</span></label>
						<select name="id_lisensi" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>No. Lisensi <span class="red">*</span></label>
						<input type="text" name="no_lisensi" class="form-control" placeholder="No. Lisensi">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Terbit <span class="red">*</span></label>
						<input type="text" name="tgl_terbit" class="form-control tgl" placeholder="Tanggal Terbit">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Berlaku <span class="red">*</span></label>
						<input type="text" name="tgl_berlaku" class="form-control tgl" placeholder="Tanggal Berlaku">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>File Lisensi</label>
						<input type="file" name="file_lisensi" class="custom-file">
						<br><small>(Format Pdf : pdf, jpg, jpeg, png)</small>
						<span class="help-block"></span>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSaveLisensi" onclick="save_lisensi()" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-share-square"></i> Batal</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_form_rating" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal-title-rating"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form_rating">
					<input type="hidden" name="id_history_rating">
					<div class="form-group">
						<label>Jenis Rating <span class="red">*</span></label>
						<select name="id_rating" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Terbit <span class="red">*</span></label>
						<input type="text" name="tgl_terbit_rating" class="form-control tgl" placeholder="Tanggal Terbit">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Berlaku <span class="red">*</span></label>
						<input type="text" name="tgl_berlaku_rating" class="form-control tgl" placeholder="Tanggal Berlaku">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>File Rating</label>
						<input type="file" name="file_rating" class="custom-file">
						<br><small>(Format Pdf : pdf, jpg, jpeg, png)</small>
						<span class="help-block"></span>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSaveRating" onclick="save_rating()" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-share-square"></i> Batal</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_form_medex" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal-title-medex"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form_medex">
					<input type="hidden" name="id_medex">
					<div class="form-group">
						<label>No. Sertifikat <span class="red">*</span></label>
						<input type="text" name="no_sertifikat" class="form-control" placeholder="No. Sertifikat">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Hasil <span class="red">*</span></label>
						<select name="hasil" class="form-control">
							<option value="FIT">FIT</option>
							<option value="UNFIT">UNFIT</option>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Dikeluarkan <span class="red">*</span></label>
						<input type="text" name="tgl_dikeluarkan" class="form-control tgl" placeholder="Tanggal Dikeluarkan">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Berlaku <span class="red">*</span></label>
						<input type="text" name="tgl_berlaku" class="form-control tgl" placeholder="Tanggal Berlaku">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>File Sertifikat</label>
						<input type="file" name="file_sertifikat" class="custom-file">
						<br><small>(Format Pdf : pdf, jpg, jpeg, png)</small>
						<span class="help-block"></span>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSaveMedex" onclick="save_medex()" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-share-square"></i> Batal</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_form_icao" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title modal-title-icao"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form_icao">
					<input type="hidden" name="id_icao">
					<div class="form-group">
						<label>No. Sertifikat <span class="red">*</span></label>
						<input type="text" name="no_sertifikat" class="form-control" placeholder="No. Sertifikat">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Level <span class="red">*</span></label>
						<select name="level" class="form-control">
							<option value="1">Level 1</option>
							<option value="2">Level 2</option>
							<option value="3">Level 3</option>
							<option value="4">Level 4</option>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Dikeluarkan <span class="red">*</span></label>
						<input type="text" name="tgl_dikeluarkan" class="form-control tgl" placeholder="Tanggal Dikeluarkan">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Berlaku <span class="red">*</span></label>
						<input type="text" name="tgl_berlaku" class="form-control tgl" placeholder="Tanggal Berlaku">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>File Sertifikat</label>
						<input type="file" name="file_sertifikat" class="custom-file">
						<br><small>(Format Pdf : pdf, jpg, jpeg, png)</small>
						<span class="help-block"></span>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSaveIcao" onclick="save_icao()" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-share-square"></i> Batal</button>
			</div>
		</div>
	</div>
</div>