<div class="col-md-12">
	<div class="float">
		<a href="<?= base_url('Project/detail/'). $project1['id_project']; ?>" class="btn btn-danger mb-2">Kembali</a>
	</div>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<?php if ($this->session->flashdata('acc')): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<?= $this->session->flashdata('acc') ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php elseif ($this->session->flashdata('err')): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<?= $this->session->flashdata('err') ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php endif ?>
			<div class="float-right">
				<br>
				<a data-toggle="modal" data-target="#modalAdd1" class="btn btn-danger mb-2">Tambah
					Kegiatan</a>
				<a data-toggle="modal" data-target="#modalSub2" class="btn btn-danger mb-2">Tambah
					Sub Kegiatan</a>
			</div>


			<h6 class="m-0 font-weight-bold text-primary">TABEL KEGIATAN DEVELOPMENT</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr class="table-warning">
							<th width="5px">Nomor</th>
							<th>Nama Kegiatan</th>
							<th>Bobot</th>
							<th>Progres</th>
							<th>Persentase</th>
							<th>Plan Start Date</th>
							<th>Plan End Date</th>
							<th>Actual Start Date</th>
							<th>Actual End Date</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($dev as $d): ?>
						<tr>
							<td>
								<?= $i; ?>.
							</td>
							<td>
								<?php echo $d->namakeg; ?>
							</td>
							<td>
								<?php echo $d->bobot; ?>
							</td>
							<td>
								<?php echo $d->progres; ?>
							</td>
							<td>

							</td>
							<td>
								<?php echo $d->planstdate; ?>
							</td>
							<td>
								<?php echo $d->planendate; ?>
							</td>
							<td>
								<?php echo $d->actualstdate; ?>
							</td>
							<td>
								<?php echo $d->actualendate; ?>
							</td>
							<td>
								<a href="javascript:;" data-id="<?php echo $d->id ?>"
									data-idpro="<?php echo $d->project_id ?>"
									data-namakeg="<?php echo $d->namakeg ?>"
									data-bobot="<?php echo $d->bobot ?>" 
									data-progres="<?php echo $d->progres ?>"
									data-planstdate="<?php echo $d->planstdate ?>"
									data-planendate="<?php echo $d->planendate ?>"
									data-actualstdate="<?php echo $d->actualstdate ?>"
									data-actualendate="<?php echo $d->actualendate ?>"
									data-file="<?php echo $d->file ?>" data-toggle="modal"
									data-target="#editModal_<?php echo $d->id ?>">
									<button class="badge badge-warning">Ubah</button>
								</a>
								<a href="javascript:;" data-toggle="modal"
									data-target="#subdevModal_<?php echo $d->id ?>">
									<button class="badge badge-primary">Sub Development Detail</button>
								</a>


								<a href="<?= base_url('Project/hapuskeg/') . $d->id; ?>" class="badge badge-danger"
									onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"
									class="ik ik-trash-2 text-red">Hapus</a>
							</td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Tambah Kegiatan -->

<div class="modal fade" id="modalAdd1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('Project/editdev/' . $project1['id_project']); ?>" method="post"
				enctype="multipart/form-data">
				<div class="modal-body">

					<input type="hidden" name="project_id" value="<?= $project1['id_project']; ?>" id="project_id">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Kegiatan</label>
						<div class="col-sm-10">
							<input type="text" name="namakeg" class="form-control form-control-user"
								value="<?= set_value('namakeg'); ?>" id="namakeg" placeholder="Masukkan nama kegiatan ">
							<?= form_error('namakeg', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Bobot</label>
						<div class="col-sm-10">
							<input type="text" name="bobot" class="form-control form-control-user"
								value="<?= set_value('bobot'); ?>" id="bobot" placeholder="Masukkan bobot ">
							<?= form_error('bobot', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Progres</label>
						<div class="col-sm-10">
							<input type="text" name="progres" class="form-control form-control-user"
								value="<?= set_value('progres'); ?>" id="progres" placeholder="Masukkan progres">
							<?= form_error('progres', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Plan Start Date</label>
						<div class="col-sm-10">
							<input type="date" id="planstartdate" name="planstdate"
								class="form-control form-control-user" value="<?= set_value('planstdate'); ?>"
								id="planstdate">
							<?= form_error('planstdate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Plan End Date</label>
						<div class="col-sm-10">
							<input type="date" id="planendate" name="planendate" class="form-control form-control-user"
								value="<?= set_value('planendate'); ?>" id="planendate">
							<?= form_error('planendate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Actual Start Date </label>
						<div class="col-sm-10">
							<input type="date" id="actualstdate" name="actualstdate"
								class="form-control form-control-user" value="<?= set_value('actualstdate'); ?>"
								id="actualstdate">
							<?= form_error('actualstdate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Actual End Date </label>
						<div class="col-sm-10">
							<input type="date" id="actualendate" name="actualendate"
								class="form-control form-control-user" value="<?= set_value('actualendate'); ?>"
								id="actualendate">
							<?= form_error('actualendate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Upload File</label>
						<div class="col-sm-10">
							<input type="file" name="file" class="form-control form-control-user"
								value="<?= set_value('namaproject'); ?>" id="file" placeholder="Masukkan nama aplikasi">
							<?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Tambah Sub Kegiatan -->

<div class="modal fade" id="modalSub2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="<?php echo base_url('Project/subdev/' . $project1['id_project']); ?>" method="post"
				enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Sub Kegiatan Baru
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="project_id" value="<?= $project1['id_project']; ?>" id="project_id">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Main Kegiatan</label>
						<div class="col-sm-10">
							<select name="id_dev" id="id_dev" class="form-control">
								<option hidden>Pilih Main Kegiatan</option>
								<?php foreach ($dev as $k): ?>
								<option value="<?= $k->id; ?>"><?= $k->namakeg ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('sumber', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Kegiatan</label>
						<div class="col-sm-10">
							<input type="text" name="namakeg" class="form-control form-control-user"
								value="<?= set_value('namakeg'); ?>" id="namakeg" placeholder="Masukkan nama kegiatan ">
							<?= form_error('namakeg', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Bobot</label>
						<div class="col-sm-10">
							<input type="number" name="bobot" class="form-control form-control-user"
								value="<?= set_value('bobot'); ?>" id="bobot" placeholder="Masukkan bobot ">
							<?= form_error('bobot', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Progres</label>
						<div class="col-sm-10">
							<input type="number" name="progres" class="form-control form-control-user"
								value="<?= set_value('progres'); ?>" id="progres" placeholder="Masukkan progres">
							<?= form_error('progres', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Plan Start Date</label>
						<div class="col-sm-10">
							<input type="date" id="planstartdate" name="planstdate"
								class="form-control form-control-user" value="<?= set_value('planstdate'); ?>"
								id="planstdate">
							<?= form_error('planstdate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Plan End Date</label>
						<div class="col-sm-10">
							<input type="date" id="planendate" name="planendate" class="form-control form-control-user"
								value="<?= set_value('planendate'); ?>" id="planendate">
							<?= form_error('planendate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Actual Start Date </label>
						<div class="col-sm-10">
							<input type="date" id="actualstdate" name="actualstdate"
								class="form-control form-control-user" value="<?= set_value('actualstdate'); ?>"
								id="actualstdate">
							<?= form_error('actualstdate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Actual End Date </label>
						<div class="col-sm-10">
							<input type="date" id="actualendate" name="actualendate"
								class="form-control form-control-user" value="<?= set_value('actualendate'); ?>"
								id="actualendate">
							<?= form_error('actualendate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Upload File</label>
						<div class="col-sm-10">
							<input type="file" name="file" class="form-control form-control-user"
								value="<?= set_value('namaproject'); ?>" id="file" placeholder="Masukkan nama aplikasi">
							<?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Ubah Kegiatan -->

<?php foreach ($dev as $d): ?>
<form action="<?php echo site_url('Project/ubahdev/') . $d->id ?>" method="POST" enctype="multipart/form-data"
	onsubmit="return validateForm()">
	<div class="modal fade" id="editModal_<?php echo $d->id ?>" role="dialog" tabindex="-1"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<input type="hidden" name="project_id" value="<?= $project1['id_project']; ?>" id="project_id">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<input type="hidden" name="id_project">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Bobot</label>
						<div class="col-sm-9">
							<input type="number" name="bobot" class="form-control" id="bobot"
								value="<?php echo $d->bobot; ?>" readonly>
							<?= form_error('bobot', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Progres</label>
						<div class="col-sm-9">
							<input type="number" name="progres" class="form-control form-control-user"
								id="progres" value="<?php echo $d->progres; ?>" placeholder="Masukkan progres">
							<?= form_error('progres', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Plan
							Start Date</label>
						<div class="col-sm-9">
							<input type="date" id="planstdate" name="planstdate"
								value="<?php echo $d->planstdate; ?>" class="form-control form-control-user"
								id="planstdate">
							<?= form_error('planstdate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Plan
							End Date</label>
						<div class="col-sm-9">
							<input type="date" id="planendate" name="planendate"
								class="form-control form-control-user" value="<?php echo $d->planendate; ?>"
								id="planendate">
							<?= form_error('planendate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Actual Start Date
						</label>
						<div class="col-sm-9">
							<input type="date" id="actualstdate" name="actualstdate"
								class="form-control form-control-user" value="<?php echo $d->actualstdate; ?>"
								id="actualstdate">
							<?= form_error('actualstdate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Actual EndDate
						</label>
						<div class="col-sm-9">
							<input type="date" id="actualendate" name="actualendate"
								class="form-control form-control-user" value="<?php echo $d->actualendate; ?>"
								id="actualendate">
							<?= form_error('actualendate', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Upload
							File</label>
						<div class="col-sm-9">
							<?php echo $d->file; ?>
							<input type="file" name="file" class="form-control form-control-user"
								value="<?php echo $d->file; ?>" id="file" placeholder="Masukkan file">
							<?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>


					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" onclick="validateForm()"
							id="btn-ok">Update</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal fade" id="subdevModal_<?php echo $d->id ?>" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Daftar Sub Kegiatan <?php echo $d->namakeg ?>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<thead>
						<tr class="table-warning">
							<th>Nama Sub</th>
							<th>Bobot</th>
							<th>Progres</th>
							<th>Plan Start Date</th>
							<th>Plan End Date</th>
							<th>Actual Start Date</th>
							<th>Actual End Date</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; $sub = $this->Development_model->getSub($d->id);?>
						<?php foreach ($sub as $d): ?>
						<tr>
							<td>
								<?php echo $d['namakeg']; ?>
							</td>
							<td>
								<?php echo $d['bobot']; ?>
							</td>
							<td>
								<?php echo $d['progres']; ?>
							</td>
							<td>
								<?php echo $d['planstdate']; ?>
							</td>
							<td>
								<?php echo $d['planendate']; ?>
							</td>
							<td>
								<?php echo $d['actualstdate']; ?>
							</td>
							<td>
								<?php echo $d['actualendate']; ?>
							</td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>

</div>
</div>
</div>
</div>
</div>
<script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>
<script src="<?= base_url('assets') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
