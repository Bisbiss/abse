<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Belum Absensi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() . 'admin' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Belum Absens</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- pp -->

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
                                    <h3 class="card-title">Data Belum Absensi Hari Ini</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <!-- <a href="#" class="breadcrumb-item" data-toggle="modal" data-target="#tambahguru">Tambah Siswa</a> -->
                                </div>
                            </div>
                        </div>

                        <div class="card-body overflow-auto">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>L/P</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data as $siswa) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $siswa->Nama_Siswa; ?></td>
                                            <td><?= $siswa->NIS; ?></td>
                                            <td><?= $siswa->Jenis_Kelamin; ?></td>
                                            <td><?= $siswa->Nama_Kelas; ?></td>
                                            <td><a href="#" class="btn btn-success btn-flat btn-xs" data-toggle="modal" data-target="<?= '#presensi' . $no ?>"><i class="fas fa-plus"></i> Presensi</a></td>
                                        </tr>

                                        <!-- modal presensi -->
                                        <div class="example-modal">
                                            <div id="<?= 'presensi' . $no ?>" class="modal fade" role="dialog" style="display:none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Presensi</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/admin/presensi" method="post" role="form">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-3 control-label text-right">ID Siswa</span></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" name="ID_Siswa" value="<?= $siswa->ID_Siswa ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-3 control-label text-right">Nama</span></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" name="Nama_Siswa" value="<?= $siswa->Nama_Siswa ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-3 control-label text-right">NIS</span></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" name="NIS" value="<?= $siswa->NIS ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-3 control-label text-right">Kelas</span></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" name="Nama_Kelas" value="<?= $siswa->Nama_Kelas ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-3 control-label text-right">Keterangan <span class="text-red">*</span></label>
                                                                        <div class="col-sm-8">
                                                                            <select id="Keterangan" name="Keterangan" class="form-control select2" style="width: 100%;">
                                                                                <option value="">-- Pilih Keterangan --</option>
                                                                                <option value="hadir">Hadir</option>
                                                                                <option value="sakit">Sakit</option>
                                                                                <option value="izin">Izin</option>
                                                                                <option value="alpha">Tanpa Keterangan</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                                                    <input type="submit" name="submit" class="btn btn-success" value="Presensi">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- endModalPresensi -->

                                        <?php endforeach; ?>
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