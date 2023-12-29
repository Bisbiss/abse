 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profil Sekolah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Profil Sekolah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h3>Pengaturan Profil Sekolah</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="" class=" control-label">Nama Sekolah</label>
                                            <input type="text" name="namaSekolah" class="form-control" id="namaSekolah" placeholder="" value="<?= $data->namaSekolah ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">Alamat Sekolah</label>
                                            <textarea type="text" name="alamatSekolah" class="form-control" id="alamatSekolah" placeholder="" required><?= $data->alamat ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">No. Telpon</label>
                                            <input type="text" name="noTelpon" class="form-control" id="noTelpon" value="<?= $data->notelpon ?>" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">Email</label>
                                            <input type="text" name="email" class="form-control" id="email" value="<?= $data->email ?>" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">Website</label>
                                            <input type="text" name="website" class="form-control" id="website" value="<?= $data->website ?>" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">Nomor Ijin</label>
                                            <input type="text" name="no_ijin" class="form-control" id="no_ijin" value="<?= $data->no_ijin ?>" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">NPSN</label>
                                            <input type="text" name="npsn" class="form-control" id="npsn" value="<?= $data->npsn ?>" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="" class=" control-label">Nama Kepala Sekolah</label>
                                            <input type="text" name="nmKepSek" class="form-control" id="nmKepSek" value="<?= $data->nmKepSek ?>" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">NIP Kepala Sekolah</label>
                                            <input type="text" name="nipKepSek" class="form-control" id="nipKepSek" value="<?= $data->nipKepSek ?>" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">Tahun Ajaran</label>
                                            <input type="text" name="tahun_ajaran" class="form-control" id="tahun_ajaran" value="<?= $data->tahun_ajaran ?>" placeholder="" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class=" control-label">Logo</label>
                                            <input type="file" name="logo" class="form-control" id="logo" placeholder="">
                                            <img src="<?= base_url().'assets/img/'.$data->logo ?>" alt="" height="50" width="50">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">Foto</label>
                                            <input type="file" name="foto" class="form-control" id="foto" placeholder="">

                                            <img src="image/<?= $data->foto ?>" alt="" height="50" width="50">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">Foto 2</label>
                                            <input type="file" name="foto2" class="form-control" id="foto2" placeholder="">
                                            <img src="image/<?= $data->foto2 ?>" alt="" height="50" width="50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="hidden" name="act" value="edit">
                                <button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>