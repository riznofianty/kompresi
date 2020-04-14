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
                                    <i class="pe-7s-info icon-gradient bg-happy-itmeo">
                                    </i>
                                </div>
                                <div>Tentang
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row circular-image center">
                        <img class="foto" src="img/pi.jpg"/>
                    </div>
                    
                   <!--  <div class="row">
                            <div class="col-md-12">
                                <div id="accordion" class="accordion-wrapper mb-3">
                                    <div class="card">
                                        <div id="headingOne" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne1"
                                                aria-expanded="true" aria-controls="collapseOne"
                                                class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Buka Menu Kompresi</h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne"
                                            class="collapse show">
                                            <div class="card-body">Pilih salah satu algoritma yang akan digunakan.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingTwo" class="b-radius-0 card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne2"
                                                aria-expanded="false" aria-controls="collapseTwo"
                                                class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Unggah File TXT</h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne2" class="collapse">
                                            <div class="card-body">Pilih file TXT yang akan dikompres dari Personal Computer (PC) dengan meng-klik button Pilih File
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingThree" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne3"
                                                aria-expanded="false" aria-controls="collapseThree"
                                                class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Unduh File Kompresi</h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne3" class="collapse">
                                            <div class="card-body">Tunggu proses kompresi selesai, sistem akan menampilkan hasil perhitungan Compression Ratio, Ratio of Compression, Bit Rate, Space Saving, dan Lamanya proses kompresi. Setelah itu, Anda dapat mengunduh file kompresi (.er atau .fle) ke dalam PC Anda.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                </div>
                <?php include '../template/footer.php' ?>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <?php include '../template/script.php' ?>
</body>

</html>