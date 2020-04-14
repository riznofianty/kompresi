<!Doctype html>
<html lang="en">

<?php include '../template/head.php' ?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php include '../template/nav-head.php' ?>
        <div class="app-main">
            <?php include '../template/nav.php' ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                   <div class="app-page-title" style="margin-bottom: -20px;">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-help1 icon-gradient bg-happy-itmeo">
                                    </i>
                                </div>
                                <div>Panduan Pengguna
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div id="accordion" class="accordion-wrapper mb-3">
                                    <div class="card">
                                        <div id="headingOne" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne1"
                                                aria-expanded="true" aria-controls="collapseOne"
                                                class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0"><i class="metismenu-icon pe-7s-info">  Informasi Sistem</i></h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne"
                                            class="collapse show">
                                            <div class="card-body">Terdiri dari beberapa konten, yaitu halaman panduan pengguna dan halaman informasi penulis.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingTwo" class="b-radius-0 card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne2"
                                                aria-expanded="false" aria-controls="collapseTwo"
                                                class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0"><i class="metismenu-icon pe-7s-info">  Kompresi</i></h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne2" class="collapse">
                                            <div class="card-body">Terdiri dari 2 pilihan algoritma kompresi, yaitu <i>Even-Rodeh Code</i> dan <i>Fixed Length Encode</i>.<br><br>
                                            Bagaimana cara mengompres File TXT?<br> 
                                            <ul>
                                                <li>Pilih algoritma yang ingin digunakan</li>
                                                <li>Upload <i>file</i> TXT yang akan dikompres, ukuran <i>file</i> tidak dibatasi</li>
                                                <li>Tunggu proses kompresi selesai. Setelah proses kompresi selesai, sistem akan menampilkan isi <i>file</i> sesudah didekompres, lamanya proses kompresi, perubahan ukuran <i>file</i> sebelum dan sesudah dikompres, ukuran <i>Compression ratio</i>, ukuran <i>Ratio of compression</i>, ukuran <i>Bit rate</i>, dan ukuran <i>Space saving</i></li>
                                                <li>Unduh <i>file</i> hasil kompresi (.er atau .fle) ke dalam PC Anda</li>
                                                <li>Selesai</li>
                                            </ul>                       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingThree" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne3"
                                                aria-expanded="false" aria-controls="collapseThree"
                                                class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0"><i class="metismenu-icon pe-7s-info">  Dekompresi</i></h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne3" class="collapse">
                                            <div class="card-body">Terdiri dari 2 pilihan algoritma dekompresi, yaitu <i>Even-Rodeh Code</i> dan <i>Fixed Length Encode</i>.<br><br>
                                            Bagaimana cara melakukan dekompres File ER dan FLE?<br> 
                                            <ul>
                                                <li>Pilih algoritma yang ingin digunakan</li>
                                                <li>Upload <i>file</i> .er atau .fle yang akan didekompres</li>
                                                <li>Tunggu proses dekompresi selesai. Setelah proses dekompresi selesai, sistem akan menampilkan isi <i>file</i> sesudah didekompresi, lamanya proses dekompresi, perubahan ukuran <i>file</i> sebelum dan sesudah didekompres.</li>
                                                <li>Unduh <i>file</i> hasil dekompresi (.txt) ke dalam PC Anda</li>
                                                <li>Selesai</li>
                                            </ul>                       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <?php include '../template/footer.php' ?>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <?php include '../template/script.php' ?>
</body>

</html>