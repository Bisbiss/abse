<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() . 'admin' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Siswa</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php
            if (session()->getFlashdata('failed')) {
                echo "<div class='alert alert-danger'><marquee>" . session()->getFlashdata('failed') . "</marquee></div>";
            }
            if (session()->getFlashdata('success')) {
                echo "<div class='alert alert-success'><marquee>" . session()->getFlashdata('success') . "</marquee></div>";
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data Siswa</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="#" class="breadcrumb-item" data-toggle="modal" data-target="#tambahsiswa">Tambah Siswa</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body overflow-auto">
                            <form method="POST" action="<?= base_url() . 'admin/datasiswa' ?>">
                                <div class="col-md-12 row justify-content-end">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label ">
                                                Kelas
                                            </label>
                                            <div class="col-md-8">
                                                <select name="kelas" class="form-control select2 " style="width: 100%;">
                                                    <option value="" selected="selected">-- Pilih Kelas --</option>
                                                    <?php
                                                    $db = db_connect();
                                                    $query_kelas = "SELECT ID_Kelas, Nama_Kelas FROM kelas";
                                                    $result = $db->query($query_kelas)->getResult();
                                                    foreach ($result as $result) {
                                                        if (isset($kelas)) {
                                                            $sel = ($kelas == $result->ID_Kelas) ? 'selected' : '';
                                                            echo '<option value="' . $result->ID_Kelas . '" ' . $sel . '>' . $result->Nama_Kelas . '</option>';
                                                        } else {
                                                            echo '<option value="' . $result->ID_Kelas . '">' . $result->Nama_Kelas . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-success" style="float:right"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No.</th>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $data) {
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data->Nama_Siswa ?></td>
                                            <td><?= $data->NIS ?></td>
                                            <td><?= $data->Nama_Kelas ?></td>
                                            <td><?= $data->Alamat ?></td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="<?= '#ubahsiswa' . $no ?>"><i class="fa fa-pen"></i> Ubah</a> |
                                                <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="<?= '#hapussiswa' . $no ?>"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                            <!-- Modal Ubah Data -->
                                            <div class="example-modal">
                                                <div id="<?= 'ubahsiswa' . $no ?>" class="modal fade" role="dialog" style="display:none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Ubah Data Siswa</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/admin/ubahsiswa" method="post" role="form" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label class="col-sm-3 control-label text-right">ID Siswa<span class="text-red">*</span></label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="ID_Siswa" value="<?= $data->ID_Siswa ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label class="col-sm-3 control-label text-right">Nama<span class="text-red">*</span></label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value="<?= $data->Nama_Siswa ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label class="col-sm-3 control-label text-right">NIS<span class="text-red">*</span></label>
                                                                            <div class="col-sm-8"><input type="text" class="form-control" name="nis" placeholder="NIS" value="<?= $data->NIS ?>" required></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label class="col-sm-3 control-label text-right">Tgl. Lahir<span class="text-red">*</span></label>
                                                                            <div class="col-sm-8"><input type="date" class="form-control" name="date" placeholder="tgl. lahir" value="<?= $data->Tanggal_Lahir ?>" required></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label class="col-sm-3 control-label text-right">Alamat<span class="text-red">*</span></label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control" name="alamat" placeholder="Alamat" required><?= $data->Alamat ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label class="col-sm-3 control-label text-right">Gender <span class="text-red">*</span></label>
                                                                            <div class="col-sm-8">
                                                                                <select name="jenis_kelamin" class="form-control select2" style="width: 100%;">
                                                                                    <option value="PEREMPUAN" <?= ($data->Jenis_Kelamin == 'PEREMPUAN') ? 'selected' : '' ?>>Perempuan</option>
                                                                                    <option value="LAKI - LAKI" <?= ($data->Jenis_Kelamin != 'PEREMPUAN') ? 'selected' : '' ?>>LAKI - LAKI</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label class="col-sm-3 control-label text-right">Kelas <span class="text-red">*</span></label>
                                                                            <div class="col-sm-8">
                                                                                <select name="kelas" class="form-control select2" style="width: 100%;" required>
                                                                                    <?php
                                                                                    $db = db_connect();
                                                                                    $query = "SELECT ID_Kelas, Nama_Kelas FROM kelas";
                                                                                    $result = $db->query($query)->getResult();
                                                                                    foreach ($result as $row) { ?>
                                                                                        <option value="<?= $row->ID_Kelas ?>" <?php if ($data->ID_Kelas == $row->ID_Kelas) echo "selected" ?>> <?= $row->Nama_Kelas ?></option>;
                                                                                    <?php }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label class="col-sm-3 control-label text-right">Chat Id</label>
                                                                            <div class="col-sm-8"><input type="text" class="form-control" name="chat_id" placeholder="Chat Id" value="<?= $data->chat_id ?>"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                                                        <input type="submit" name="submit" class="btn btn-primary" value="Ubah Data">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus Data -->
                                            <div class="example-modal">
                                                <div id="<?= 'hapussiswa' . $no ?>" class="modal fade" role="dialog" style="display:none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Konfirmasi Hapus Data Siswa</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4 class="text-center">
                                                                    Apakah anda yakin ingin menghapus Siswa <?= " " . $data->ID_Siswa . ' - ' . $data->Nama_Siswa ?><strong><span class="grt"></span></strong> ?
                                                                </h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button id="nodelete" type="button" class="btn btn-light pull-left" data-dismiss="modal">Batal</button>
                                                                <a href="<?= '/admin/hapussiswa/' . $data->ID_Siswa ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>

<div class="example-modal">
    <div id="tambahsiswa" class="modal fade" role="dialog" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Siswa Baru</h3>
                </div>
                <div class="modal-body">
                    <form action="/admin/tambahsiswa" method="post" role="form" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Id Siswa<span class="text-red">*</span></label>
                                <div class="col-sm-8"><input type="text" class="form-control" name="id_siswa" placeholder="ID CARD" value="" required></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Nama<span class="text-red">*</span></label>
                                <div class="col-sm-8"><input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value="" required></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">NIS<span class="text-red">*</span></label>
                                <div class="col-sm-8"><input type="text" class="form-control" name="nis" placeholder="NIS" value="" required></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Tgl. Lahir<span class="text-red">*</span></label>
                                <div class="col-sm-8"><input type="date" class="form-control" name="date" placeholder="tgl. lahir" value="" required></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Alamat<span class="text-red">*</span></label>
                                <div class="col-sm-8"><textarea class="form-control" name="alamat" placeholder="Alamat" value="" required></textarea></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Gender <span class="text-red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="jenis_kelamin" class="form-control select2" style="width: 100%;" required>
                                        <option value="" selected="selected">-- Pilih Satu --</option>
                                        <option value="PEREMPUAN">Perempuan</option>
                                        <option value="LAKI - LAKI">LAKI - LAKI</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Kelas <span class="text-red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="kelas" class="form-control select2" style="width: 100%;" required>
                                        <option value="" selected="selected">-- Pilih Satu --</option>
                                        <?php
                                        $query_kelas = "SELECT ID_Kelas, Nama_Kelas FROM kelas";
                                        $result_kelas = $db->query($query_kelas)->getResult();

                                        foreach ($result_kelas as $row_kelas) {
                                            echo '<option value="' . $row_kelas->ID_Kelas . '">' . $row_kelas->Nama_Kelas . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Foto<span class="text-red">*</span></label>
                                <div class="col-sm-8"><input type="file" class="form-control" name="foto"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Chat Id</label>
                                <div class="col-sm-8"><input type="text" class="form-control" name="chat_id" placeholder="Chat Id" value=""></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                            <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>