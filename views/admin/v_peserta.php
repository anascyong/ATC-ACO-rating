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
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th></th>
						<th>No</th>
						<th>Nama</th>
						<th>No. Identitas</th>
						<th>Jenis Kelamin</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Kebangsaan</th>
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
					<input type="hidden" name="id_user">
					<div class="form-group">
						<label>Nama <span class="red">*</span></label><br>
						<input type="text" name="nama_user" class="form-control" placeholder="Nama Peserta">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>No. Identitas <span class="red">*</span></label><br>
						<input type="text" name="no_identitas" class="form-control" placeholder="No. Identitas">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Jenis Kelamin <span class="red">*</span></label><br>
						<select name="id_jk" class="form-control">
							<option value="">Pilih</option>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tempat Lahir <span class="red">*</span></label><br>
						<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tanggal Lahir <span class="red">*</span></label><br>
						<input type="text" name="tanggal_lahir" class="form-control tgl" placeholder="Tanggal Lahir">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Kebangsaan <span class="red">*</span></label><br>
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
						<label>No. Hp <span class="red">*</span></label><br>
						<input type="text" name="no_hp" class="form-control" placeholder="No. Hp">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Foto <span class="red">*</span></label><br>
						<input name="foto" type="file">
						<p class="red"><span class="help-block"></span></p>
					</div>
					<div class="form-group">
						<label>KTP <span class="red">*</span></label><br>
						<input name="ktp" type="file">
						<p class="red"><span class="help-block"></span></p>
					</div>
					<div class="form-group">
						<label>Lisensi</label><br>
						<input name="lisensi" type="file">
						<p class="red"><span class="help-block"></span></p>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
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