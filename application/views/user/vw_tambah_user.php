<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <a href="<?= base_url() ?>User/" class="btn btn-info">&larr; Kembali</a>
            <br><br>
            <div class="card">
                <div class="card-header justify-content-center">
                    Add Data Form </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-sm-2 col-form-label">Gambar Profil</label>
                                    <img src="<?= base_url('assets/images/profile/default.png') ?>"
                                        style="width : 250px;" class="img-thumbnail">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="NIK" name="NIK" class="form-control form-control-user"
                                    value="<?= set_value('NIK'); ?>" id="NIK" placeholder="Masukkan NIK">
                                <?= form_error('NIK', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control" id="nama"
                                    placeholder="Masukkan Nama Lengkap">
                                <?= form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" id="email"
                                    placeholder="Masukkan E-mail">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select name="role" class="form-control" id="role">
                                    <option value="">Pilih Jabatan...</option>
                                    <option value="Pinbag">Pimpinan Bagian</option>
                                    <option value="Planning">IT Planning</option>
                                    <option value="Development">IT Development</option>
                                    <option value="Support">IT Support</option>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-5">
                                <input type="password" name="password1" value="<?= set_value('password1'); ?>"
                                    class="form-control form-control-user" id="password1" placeholder="Insert Password">
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="col-sm-5">
                                <input type="password" name="password2" value="<?= set_value('password2'); ?>"
                                    class="form-control form-control-user" id="password2" placeholder="Repeat Password">
                                <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div> -->

                        <div class="col-md-12">
                            <button type="submit" name="tambah" class="btn btn-primary float-right">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>