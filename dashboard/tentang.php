    <!Doctype html>
    <html lang="en">

    <?php include '../template/head.php' ?>
    <style type="text/css">
        .circular-image {
         width: 100px;
         height: 90px;
         overflow: hidden;
         border-radius: 50%;    
        }
        .foto {
            height: 120%;
            width: 150%;
        }
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .img {
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 20%;
          height: 50%;
          padding: 5px;
        }

    </style>

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
                                    <div>Tentang
                                        <div class="page-title-subheading">Implementasi dan Analisis Perbandingan Kinerja Algoritma Even-Rodeh Code dan Algoritma Fixed Length Encode dalam Kompresi File Teks
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 card">
                                </div>
                            <div class="col md 5">
                                <h4 style="text-align:center;">Penulis</h4>
                            </div>
                            <div class="col md 5">
                                <img src="img/rsz.jpg" class="img rounded-circle">
                            </div>
                            <div class="col md 5">
                                <h5 style="text-align:center; font-size:200%;">Rizki Nofianty Tanjung<br></h1>
                                <h6><center>161401113</center><br><br><br></h6>
                                <h5><center>Program Studi S-1 Ilmu Komputer</center></h5>
                                <h5><center>Fakultas Ilmu Komputer dan Teknologi Informasi</center></h5>
                                <h5><center>Universitas Sumatera Utara</center></h5>
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