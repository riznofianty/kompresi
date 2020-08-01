<!Doctype html>
<html lang="en">
<?php
include "../DecompressClass.php";
include '../template/head.php';
if (isset($_POST['decompress'])) {
    $file = $_POST['file-decompress'];

    $decompress = new Decompress('file/'.$file);
    $decompress->fixedLengthEncode();
  
}
?>
<style type="text/css">
    
    #kiri
    {
        width:50%;
        height:100px;
        float:left;
    }
    #kanan
    {
        width:50%;
        height:100px;
        float:right;
    }
}

</style>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php include '../template/nav-head.php' ?>
         <div class="app-main">
            <?php include '../template/nav.php' ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                     <i class="pe-7s-light icon-gradient bg-happy-itmeo"></i>
                                </div>
                                  <div>Fixed Length Encode
                                    <div class="page-title-subheading">Dekompresi
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header mt-2 mb-2 text-center">
                                    <h4>Selamat!</h4>
                                     
                                </div>
                                <div class="card-body">
                                    <div class="card mb-3 widget-content bg-midnight-bloom">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading ex1" style="font-style: italic;"><?php  echo "Running Time = ".$decompress->getTimeProccess()." detik<br>";?> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="position-relative row form-group">
                                        <div class="col-sm-12">
                                            <div class="row">
                                            <div class="col-lg-6 col-xl-4" id="kiri"><h5>Hasil Kompresi</h5>
                                                <textarea style="width: 100%;" ><?php echo $decompress->fixedLengthEncode();?></textarea>
                                            </div>
                                            <div class="col-lg-6 col-xl-4" id="kiri">
                                                        <h5>Hasil Dekompresi</h5>
                                                        <textarea style="width: 100%;"><?php echo $decompress->decStringFLE();?>
                                                        </textarea>
                                            </div>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <?php include '../template/footer.php' ?>
            </div>
         </div>
    </div>

</body>

</html>