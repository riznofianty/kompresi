<!Doctype html>
<html lang="en">
<?php
include "../CompressClass.php";
include '../template/head.php';
if (isset($_POST['compress'])) {
    
    //untuk mengambil nama filenya
    $file =  $_POST['file-compress'];
    
	$compress = new Compress('file/'.$file);	//membuat objek baru dari kelas Compress dengan fila yang akan diolah
	$compress->FixedLengthEncode();			//menjalankan fungsi FixedLengthEncode
				//menampilkan Ss
					//menampilkan Bt
				//menampilkan Tp
	
	
}

?>
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
                                    <div class="page-title-subheading">Kompresi
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
                                    <h4><?php echo "Selamat!<br>";?></h4>
                                     
                                </div>
                                <div class="card-body"><h5><?php echo "Ukuran File TXT Anda berkurang dari ".$compress->getBitBefore()." bytes menjadi ".$compress->getBitAfter()." bytes";?></h5>
                                </div>
                                <div class="card-body"><h5>String Bit Hasil Kompresi</h5>
                                  <textarea style="width: 100%;" ><?php echo $compress->FixedLengthEncode();?></textarea>
                                  </div>
                                <div class="card-body">
                                    <div class="position-relative row form-group">
                                        <div class="col-sm-12">
                                        	<div class="row">
                                        	<div class="col-lg-6 col-xl-4">
                                    			<div class="card mb-3 widget-content bg-midnight-bloom">
                                        			<div class="widget-content-wrapper text-white">
                                           				<div class="widget-content-left">
                                               				 <div class="widget-heading ex1" style="font-style: italic;">Ratio of Compression</div>
                                                				<div class="widget-subheading"style="padding-right:20px; text-align: justify;">Hasil perbandingan antara ukuran bit data sebelum dikompresi dengan ukuran bit data setelah dikompresi</div>
                                            			</div>
                                           				<div class="widget-content-right">
                                               				<div class="widget-numbers text-white"><span><?php echo $compress->getRatioOfCompression()?></span></div>
                                           				</div>
                                        			</div>
                                        		</div>
                                        	</div>
                                        	<div class="col-lg-6 col-xl-4">
                                    			<div class="card mb-3 widget-content bg-midnight-bloom">
                                        			<div class="widget-content-wrapper text-white">
                                           				<div class="widget-content-left">
                                            				<div class="widget-heading" style="font-style: italic;">Compression Ratio</div>
                                                				<div class="widget-subheading" style="padding-right:20px; text-align: justify;">Persentase perbandingan antara ukuran bit data setelah dikompresi dengan ukuran bit data sebelum dikompresi</div>
                                            			</div>
                                           				<div class="widget-content-right">
                                               				<div class="widget-numbers text-white"><span><?php echo $compress->getCompressionRatio()."%"?></span>
                                               				</div>
                                           				</div>
                                        			</div>
                                    			</div>
                                			</div>
                                			<div class="col-lg-6 col-xl-4">
                                    			<div class="card mb-3 widget-content bg-midnight-bloom">
                                        			<div class="widget-content-wrapper text-white">
                                           				<div class="widget-content-left">
                                            				<div class="widget-heading" style="font-style: italic;">Space Saving</div>
                                                				<div class="widget-subheading" style="text-align: justify;padding-right: 20px">Persentase selisih antara data awal sebelum dikompresi dengan hasil data yang telah dikompresi</div>
                                            			</div>
                                           				<div class="widget-content-right">
                                               				<div class="widget-numbers text-white"><span><?php echo $compress->getSpaceSaving()."%"?></span>
                                               				</div>
                                           				</div>
                                        			</div>
                                    			</div>
                                			</div>
                                			<div class="col-lg-6 col-xl-4">
                                    			<div class="card mb-3 widget-content bg-midnight-bloom">
                                        			<div class="widget-content-wrapper text-white">
                                           				<div class="widget-content-left">
                                            				<div class="widget-heading" style="font-style: italic;">Bit Rate</div>
                                                				<div class="widget-subheading" style="text-align: justify;padding-right: 20px;">Perbandingan antara ukuran bit terkompresi dengan jumlah jenis karakter (simbol) unik pada setiap teks</div>
                                            			</div>
                                           				<div class="widget-content-right">
                                               				<div class="widget-numbers text-white"><span><?php echo $compress->getBitRate()?></span>
                                               				</div>
                                           				</div>
                                        			</div>
                                    			</div>
                                			</div>
                                			<div class="col-lg-6 col-xl-4">
                                    			<div class="card mb-3 widget-content bg-midnight-bloom">
                                        			<div class="widget-content-wrapper text-white">
                                           				<div class="widget-content-left">
                                            				<div class="widget-heading">Waktu Kompresi</div>
                                                				<div class="widget-subheading" style="text-align: justify;padding-right: 20px">Waktu yang dibutuhkan oleh sistem untuk melakukan proses kompresi dimulai dari meng-input File teks yang akan dikompresi sampai dengan selesainya proses kompresi serta proses dekompresi berjalan</div>
                                            			</div>
                                           				<div class="widget-content-right">
                                               				<div class="widget-numbers text-white"><span><?php echo $compress->getTimeProccess()." detik"?></span>
                                               				</div>
                                           				</div>
                                        			</div>
                                    			</div>
                                			</div>
                                		</div>
                                            
                                            <span id="uploaded_file"></span>
                                            
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