<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <a href="<?= base_url() ?>User/" class="btn btn-info">&larr; Kembali ke Dashboard</a>
            <br><br>
            <div class="card">
                <div class="card-header justify-content-center">
                    Form Ubah Data User
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">

                        <div class="form-group">
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">Gambar</label>
                                <img src="<?= base_url('assets/images/profile/') . $user['gambar']; ?>"
                                    style="width : 250px;" class="img-thumbnail">
                                <label for="gambar"> </label>
                                <input type="file" name="gambar" id="gambar"
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" name="NIK" value="<?= $user['NIK']; ?>" class="form-control"
                                    id="NIK">
                                <?= form_error('NIK','<small class="text-danger pl-3">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" value="<?= $user['nama']; ?>" class="form-control"
                                    id="nama">
                                <?= form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jk" value="<?= $user['jk']; ?>" class="form-control" id="jk">
                                    <option value="<?= $user['jk']; ?>"><?= $user['jk']; ?></option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                                <?= form_error('jk','<small class="text-danger pl-3">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select name="role" class="form-control" id="role">
                                    <!-- <option value="<?= $user['role']; ?>"><?= $user['role']; ?>
                                                        </option> -->
                                    <?php foreach ($role as $p) : ?>
                                    <option value="<?=$p['role']?>"> <?= $p['role']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" value="<?= $user['password']; ?>"
                                    class="form-control form-control-user" readonly>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" name="tambah" class="btn btn-primary float-right">Update</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>