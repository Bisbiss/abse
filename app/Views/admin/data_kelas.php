<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kelas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url().'admin' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Kelas</li>
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
                                    <h3 class="card-title">Data Kelas</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="#" class="breadcrumb-item" data-toggle="modal" data-target="#tambahkelas">Tambah Kelas</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body overflow-auto">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>Nama Kelas</th>
                                    <th>Wali Kelas</th>
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
                                        <td><?= $data->Nama_Kelas ?></td>
                                        <td><?= $data->Nama_Guru ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="<?= '#ubahkelas'.$no ?>"><i class="fa fa-pen"></i> Ubah</a> |
                                            <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="<?= '#hapuskelas' . $no ?>"><i class="fa fa-trash"></i> Hapus</a>
                                        </td>
                                        
                                        <!-- Ubah Kelas -->
                                        <div class="example-modal">
                                            <div id="<?= 'ubahkelas'.$no ?>" class="modal fade" role="dialog" style="display:none;">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h3 class="modal-title">Ubah Kelas</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="/admin/ubahkelas" method="post" role="form">
                                                        <input type="hidden" name="ID_Kelas" value="<?= $data->ID_Kelas ?>">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-3 control-label text-right">Nama Kelas <span class="text-red">*</span></label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="nama_kelas" placeholder="Nama Kelas" value="<?= $data->Nama_Kelas ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-3 control-label text-right">ID Wali Kelas<span class="text-red">*</span></label>
                                                            <div class="col-sm-8">
                                                            <select name="wali_kelas" class="form-control select2" style="width: 100%;">
                                                                <?php
                                                                $db = db_connect();
                                                                $query = "SELECT * FROM guru";
                                                                $result = $db->query($query)->getResult();

                                                                foreach($result as $guru) { ?>
                                                                <option value="<?= $guru->ID_Guru ?>" <?php if($guru->ID_Guru==$data->ID_Wali_Kelas) echo "selected" ?>><?= $guru->Nama_Guru ?></option>
                                                                <?php 
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
                                            </div>
                                        </div>

                                        <!-- Hapus Kelas -->
                                        <div class="example-modal">
                                            <div id="<?= 'hapuskelas' . $no ?>" class="modal fade" role="dialog" style="display:none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Konfirmasi Hapus Data Kelas</h3>
                                                        </div>
                                                    <div class="modal-body">
                                                        <h4 class="text-center">
                                                            Apakah anda yakin ingin menghapus Kelas <?= " ".$data->Nama_Kelas ?><strong><span class="grt"></span></strong> ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="nodelete" type="button" class="btn btn-light pull-left" data-dismiss="modal">Batal</button>
                                                        <a href="<?= '/admin/hapuskelas/'.$data->ID_Kelas ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                                    </div>
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

<!-- modal insert -->
<div class="example-modal">
    <div id="tambahkelas" class="modal fade" role="dialog" style="display:none;">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title">Tambah Kelas Baru</h3>
            </div>
            <div class="modal-body">
            <form action="/admin/tambahdatakelas" method="post" role="form">
                <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label text-right">Nama Kelas <span class="text-red">*</span></label>
                    <div class="col-sm-8"><input type="text" class="form-control" name="nama_kelas" placeholder="Nama Kelas" value="" required></div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label text-right">ID Wali Kelas<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                    <select name="wali_kelas" class="form-control select2" style="width: 100%;" requied>
                        <option value="" selected="selected">-- Pilih Guru --</option>
                        <?php
                        $query_guru = "SELECT * FROM guru";
                        $result_guru = $db->query($query_guru)->getResult();

                        foreach($result_guru as $row_guru) {
                        echo '<option value="' . $row_guru->ID_Guru . '">' . $row_guru->Nama_Guru . '</option>';
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
    </div>
</div>
<!-- modal insert close -->