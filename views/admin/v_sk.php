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
				<select id="f_id_lokasi" name="f_id_lokasi" class="form-control"></select>
			</div>
			<div class="col-md-6">
				<select id="f_id_permohonan" name="f_id_permohonan" class="form-control"></select>
			</div>
		</div>
		<hr>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">Aksi</td>
						<td width="20px">No</td>
						<td>No. SK</td>
						<td>Tanggal Terbit</td>
						<td>Tanggal Berlaku</td>
						<td>Airnav</td>
						<td>Lihat SK</td>
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
					<input type="hidden" name="id_sk">
					<div class="form-group">
						<label>No. SK <span class="red">*</span></label>
						<input type="text" name="no_sk" class="form-control" placeholder="Nomor SK">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tgl. Terbit <span class="red">*</span></label>
						<input type="text" name="tgl_terbit" class="form-control tgl" placeholder="Tanggal Terbit">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Airnav <span class="red">*</span></label>
						<select id="id_lokasi" name="id_lokasi" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Jadwal Ujian <span class="red">*</span></label>
						<select id="id_permohonan" name="id_permohonan" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<table id="mytable_peserta" class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td width="20px">Aksi</td>
								<td width="20px">Evidance</td>
								<td width="20px">No</td>
								<td>Nama</td>
								<td>No. Lisensi</td>
								<td>Airnav</td>
								<td>File SK</td>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_evidance" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				
			</div>
			<div class="modal-body">
				<div id="m-btn"></div>
				<form action="#" id="form_evidance">
					<input type="hidden" name="id">
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
						<tr>
							<th>Nama Peserta</th>
							<td id="nama_user"></td>
						</tr>	
						<tr>
							<th>No Lisensi</th>
							<td id="no_lisensi"></td>
						</tr>						
					</table>
				</div>
				</form>
				<div class="table-responsive">
					<table id="mytable_evidance" class="table table-bordered table-striped" style="width: 100%">
						<thead>
							<tr>
								<th>No</th>
								<th style="width: 15px">Aksi</th>
								<th>Evidance</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-share-square-o"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_add_evidance" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>				
			</div>
			<div class="modal-body form_add_evidance">
				<form action="#" id="form_add_evidance">
					<input type="hidden" name="id">		
					<div class="form-body">								
						<div class="form-group">
        					<label>File Evidance<span class="red">*</span></label>
          					<input name="evidance" type="file">
          					<span class="help-block"></span>
      					</div>
      					<label class="control-label col-md-3">Perhatian</label>
						<div class="col-md-9">
							<p><small><span class="red">*</span> file yang diunggah harus dalam format .pdf</small></p>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSimpanEvidance" onclick="save_evidance()" class="btn btn-primary btn-flat"><i class="fa fa-check-square-o"></i> Simpan</button>
				<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-share-square-o"></i> Batal</button>
			</div>
		</div>
	</div>
</div>