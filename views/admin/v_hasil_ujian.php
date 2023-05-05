<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">
			<div class="alert alert-info" style="margin-bottom: 0rem;">
				<u><i class="fas fa-info-circle"></i> PETUNJUK</u><br>
				<small>&#x279C; Klik tombol pada kolom aksi untuk memasukkan nilai ujian</small>
			</div>
		</h6>
	</div>
	<div class="card-body">
		<div class="form-group">
			<select id="jadwal" name="id_jadwal_rtf" class="form-control"></select>
		</div>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">Aksi</td>
						<td width="20px">No</td>
						<td>Nama</td>
						<td>Identitas</td>
						<td>Kelamin</td>
						<td>TTL</td>
						<td>Lembaga</td>
						<td>Nilai</td>
						<td>Keterangan</td>
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
					<input type="hidden" name="id">
					<div class="form-group">
						<label>Nilai Teori</label>
						<input type="number" name="nilai" class="form-control" placeholder="Nilai Teori">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Nilai Re-check Teori</label>
						<input type="number" name="nilai_recheck_teori" class="form-control" placeholder="Nilai Re-check Teori">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Nilai Praktek</label>
						<input type="number" name="nilai_praktek" class="form-control" placeholder="Nilai Praktek">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Nilai Re-check Praktek</label>
						<input type="number" name="nilai_recheck_praktek" class="form-control" placeholder="Nilai Re-check Praktek">
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