<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Guru</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url().'admin' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Guru</li>
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
                                    <h3 class="card-title">Data Guru</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="#" class="breadcrumb-item" data-toggle="modal" data-target="#tambahguru">Tambah Guru</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body overflow-auto">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Guru</th>
                                        <th>Mata Pelajaran</th>
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
                                        <td><?= $data->Nama_Guru ?></td>
                                        <td><?= $data->Mata_Pelajaran ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="<?= '#ubahguru'.$no ?>"><i class="fa fa-pen"></i> Ubah</a> |
                                            <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="<?= '#hapusguru' . $no ?>"><i class="fa fa-trash"></i> Hapus</a>
                                        </td>

                                        <!-- Ubah Guru -->
                                        <div class="modal fade" id="<?= 'ubahguru'.$no ?>" tabindex="-1" role="dialog" aria-labelledby="tambahguruLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ubahGuruModalLabel">Ubah Guru</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/admin/ubahguru" method="post">
                                                            <input type="hidden" name="id_guru" value="<?= $data->ID_Guru ?>">
                                                            <div class="form-group">
                                                                <label for="nama_guru">Nama Guru:</label>
                                                                <input type="text" class="form-control" id="nama_guru" value="<?= $data->Nama_Guru ?>" name="nama_guru" placeholder="Nama Guru" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mata_pelajaran">Mata Pelajaran:</label>
                                                                <input type="text" class="form-control" id="mata_pelajaran" value="<?= $data->Mata_Pelajaran ?>" name="mata_pelajaran" placeholder="Mata Pelajaran" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hapus Kelas -->
                                        <div class="example-modal">
                                            <div id="<?= 'hapusguru' . $no ?>" class="modal fade" role="dialog" style="display:none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Konfirmasi Hapus Data Guru</h3>
                                                        </div>
                                                    <div class="modal-body">
                                                        <h4 class="text-center">
                                                            Apakah anda yakin ingin menghapus data Guru <?= " ".$data->Nama_Guru." - ".$data->Mata_Pelajaran  ?><strong><span class="grt"></span></strong> ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="nodelete" type="button" class="btn btn-light pull-left" data-dismiss="modal">Batal</button>
                                                        <a href="<?= '/admin/hapusguru/'.$data->ID_Guru ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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

<!-- Tambah Guru -->
<div class="modal fade" id="tambahguru" tabindex="-1" role="dialog" aria-labelledby="tambahguruLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahGuruModalLabel">Tambah Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/tambahdataguru" method="post">
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru:</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Nama Guru" required>
                    </div>
                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran:</label>
                        <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" placeholder="Mata Pelajaran" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>