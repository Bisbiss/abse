<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Invalid Card</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url().'admin' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data invalid Card</li>
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
                    echo "<div class='alert alert-danger'><marquee>".session()->getFlashdata('failed')."</marquee></div>";
                }
                if (session()->getFlashdata('success')) {
                    echo "<div class='alert alert-success'><marquee>".session()->getFlashdata('success')."</marquee></div>";
                }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data invalid Card</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <!-- <a href="#" class="breadcrumb-item" data-toggle="modal" data-target="#tambahkelas">Tambah Kelas</a> -->
                                </div>
                            </div>
                        </div>

                        <div class="card-body overflow-auto">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>ID Card</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $data){
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $data->id_card ?></td>
                                        <td><?= $data->waktu ?></td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="<?= '#tambah'.$no ?>"><i class="fas fa-plus"></i> Tambahkan</a>
                                        </td>
                                        <!-- Hapus Kelas -->
                                        <div class="example-modal">
                                            <div id="<?= 'tambah' . $no ?>" class="modal fade" role="dialog" style="display:none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Tambah Data</h3>
                                                        </div>
                                                    <form action="/admin/convertdata" method="post" role="form" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-3 control-label text-right">ID CARD<span class="text-red">*</span></label>
                                                                <div class="col-sm-8"><input type="text" class="form-control" name="id_siswa" placeholder="Nama Siswa" value="<?= $data->id_card ?>" readonly></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-3 control-label text-right">Nama<span class="text-red">*</span></label>
                                                                <div class="col-sm-8"><input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value=""></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-3 control-label text-right">NIS<span class="text-red">*</span></label>
                                                                <div class="col-sm-8"><input type="text" class="form-control" name="nis" placeholder="NIS" value=""></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-3 control-label text-right">Tgl. Lahir<span class="text-red">*</span></label>
                                                                <div class="col-sm-8"><input type="date" class="form-control" name="date" placeholder="tgl. lahir" value=""></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-3 control-label text-right">Alamat<span class="text-red">*</span></label>
                                                                <div class="col-sm-8"><textarea class="form-control" name="alamat" placeholder="Alamat" value=""></textarea></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-3 control-label text-right">Gender <span class="text-red">*</span></label>
                                                                <div class="col-sm-8">
                                                                    <select name="jenis_kelamin" class="form-control select2" style="width: 100%;">
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
                                                                        $db = db_connect();
                                                                        $query_kelas = "SELECT ID_Kelas, Nama_Kelas FROM kelas";
                                                                        $result_kelas = $db->query($query_kelas)->getResult();

                                                                        foreach($result_kelas as $row_kelas) {
                                                                            echo '<option value="' . $row_kelas->ID_Kelas . '">' . $row_kelas->Nama_Kelas . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
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
                                    </tr>
                                    <?php
                                    $no++; }
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