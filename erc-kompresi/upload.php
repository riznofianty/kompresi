<?php
//upload.php
if ($_FILES["file"]["name"] != '') {
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $name = $_FILES["file"]["name"];
    $location =  $name;
    move_uploaded_file($_FILES["file"]["tmp_name"], "file/" . $location);
    //embed untuk nampilin hanya file document (.txt)
    echo '<embed src="file/' . $location . '" width="100%" height="100%" class="img-thumbnail" style="margin-top:10px"/>';
    echo '
        <form action="kompres.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="' . $name . '" name="file-compress">
            <button class="btn btn-info btn-block" name="compress" style="width:15%;box-shadow: 0 5px 10px 0 rgba(0,0,0,0.2), 0 7px 20px 0 rgba(0,0,0,0.19);padding: 10px 30px;font-size: 15px;    background-color: #2748B2;border: none;">Kompres</button>
        </form>
    ';
}
