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
		<div class="row">
			<div class="col-md-6">
				<select id="f_id_bidang" name="id_bidang" class="form-control"></select>
			</div>
			<div class="col-md-6">
				<select id="f_id_jenis_soal" name="id_jenis_soal" class="form-control">
					<option value="">-- Kategori --</option>
					<option value="1">Multiple Choice</option>
					<option value="2">Essay</option>
				</select>
			</div>
		</div>
		<hr>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="30px">Aksi</th>
						<th width="20px">No</th>
						<th>Soal</th>
						<th>Bidang</th>
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
					<input type="hidden" name="id_soal">
					<div class="form-group">
						<label>Soal <span class="red">*</span></label>
						<textarea name="soal" class="form-control" placeholder="Soal"></textarea>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Kategori <span class="red">*</span></label>
						<select id="id_jenis_soal" name="id_jenis_soal" class="form-control">
							<option value="">-- Kategori --</option>
							<option value="1">Multiple Choice</option>
							<option value="2">Essay</option>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Bidang <span class="red">*</span></label>
						<select name="id_bidang" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<div class="form-group multiple-choice">
						<label>Pilihan A <span class="red">*</span></label>
						<input type="text" name="pilihan_a" class="form-control" placeholder="Pilihan A">
						<span class="help-block"></span>
					</div>
					<div class="form-group multiple-choice">
						<label>Pilihan B <span class="red">*</span></label>
						<input type="text" name="pilihan_b" class="form-control" placeholder="Pilihan B">
						<span class="help-block"></span>
					</div>
					<div class="form-group multiple-choice">
						<label>Pilihan C <span class="red">*</span></label>
						<input type="text" name="pilihan_c" class="form-control" placeholder="Pilihan C">
						<span class="help-block"></span>
					</div>
					<div class="form-group multiple-choice">
						<label>Pilihan D <span class="red">*</span></label>
						<input type="text" name="pilihan_d" class="form-control" placeholder="Pilihan D">
						<span class="help-block"></span>
					</div>
					<div class="form-group multiple-choice">
						<label>Jawaban <span class="red">*</span></label>
						<select name="jawaban" class="form-control">
							<option value="">-- Pilih --</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
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
<div id="modal_view" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered" width="100%" cellspacing="0">
						<tr>
							<th>Soal</th>
							<td class="v_soal"></td>
						</tr>
						<tr>
							<th>Bidang</th>
							<td class="v_nama_bidang"></td>
						</tr>
						<tr>
							<th>Kategori</th>
							<td class="v_jenis_soal"></td>
						</tr>
						<tr class="multiple-choice">
							<th>Pilihan A</th>
							<td class="v_pilihan_a"></td>
						</tr>
						<tr class="multiple-choice">
							<th>Pilihan B</th>
							<td class="v_pilihan_b"></td>
						</tr>
						<tr class="multiple-choice">
							<th>Pilihan C</th>
							<td class="v_pilihan_c"></td>
						</tr>
						<tr class="multiple-choice">
							<th>Pilihan D</th>
							<td class="v_pilihan_d"></td>
						</tr>
						<tr class="multiple-choice">
							<th>Jawaban</th>
							<td class="v_jawaban"></td>
						</tr>
						<tr>
							<th>Tanggal Dibuat</th>
							<td class="v_created"></td>
						</tr>
						<tr>
							<th>Dibuat Oleh</th>
							<td class="v_creator"></td>
						</tr>
						<tr>
							<th>Tanggal Dirubah</th>
							<td class="v_edited"></td>
						</tr>
						<tr>
							<th>Dirubah Oleh</th>
							<td class="v_editor"></td>
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