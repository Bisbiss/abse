<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Import Siswa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                                <li class="breadcrumb-item active">Import Siswa</li>
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
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form method="POST" class="form-horizontal" action="/admin/importsiswa" enctype="multipart/form-data">
                                            <div class="col-md-12">
                                                <a href="<?= base_url().'assets/absen/contoh/contohimportsiswa.xls' ?>">Contoh Format Import</a>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="" class="col-sm-4 control-label">Pilih File Excel (.xls / Format Excel 2003)</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="fileSiswa" class="form-control" id="fileSiswa" placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <input type="submit" name="prosesimport" value="Proses Import" class="btn btn-success">
                                                <!-- <button type="submit" class="btn btn-dark">Proses</button> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->