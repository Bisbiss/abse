<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Absen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url().'admin' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Absen</li>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data Absen</h3>
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
                                        <th>L/P</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                        <th>Waktu</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $data){
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $data->Nama_Siswa ?></td>
                                        <td><?= ($data->Jenis_Kelamin=='PEREMPUAN' ? 'P' : 'L'); ?></td>
                                        <td><?= $data->NIS ?></td>
                                        <td><?= $data->Nama_Kelas ?></td>
                                        <td><?= $data->Waktu_Absensi ?></td>
                                        <td><img src="<?= base_url().'assets/absen/capture/'.$data->foto_siswa ?>" class="img-fluid" width="100px"></td>
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