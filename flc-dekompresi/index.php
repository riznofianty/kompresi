<?php
?>
<!Doctype html>
<html lang="en">

<?php include '../template/head.php' ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<style>
    .btn-group-xs>.btn,
    .btn-xs {
        /* padding: .25rem .4rem;
        font-size: .875rem; 
        line-height: .5; */
        border-radius: 8.2rem;
    }
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>

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
                                    <i class="pe-7s-light icon-gradient bg-happy-itmeo">
                                    </i>
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
                                    <h2>Upload File</h2>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative row form-group">
                                        <div class="col-sm-12">
                                            <div class="fileUpload btn btn-info text-center">
                                                <span>Upload</span>
                                                <input name="file" id="file" type="file" class="form-control-file upload text-center" accept=".txt" required>
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
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <?php include '../template/script.php' ?>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#file', function() {
                var name = document.getElementById("file").files[0].name;
                var form_data = new FormData();
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['txt']) == -1) {
                    alert("Invalid File");
                }
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("file").files[0]);
                var f = document.getElementById("file").files[0];
                var fsize = f.size || f.fileSize;
                if (fsize > 2000000) {
                    alert("File Size is very big");
                } else {
                    form_data.append("file", document.getElementById('file').files[0]);
                    $.ajax({
                        url: "upload.php",
                        method: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#uploaded_file').html("<label class='text-success'>File Uploading...</label>");
                        },
                        success: function(data) {
                            $('#uploaded_file').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>