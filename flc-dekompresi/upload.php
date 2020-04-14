<?php
//upload.php
if ($_FILES["file"]["name"] != '') {
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $name = rand(100, 999) . '.' . $ext;
    $location =  $name;
    move_uploaded_file($_FILES["file"]["tmp_name"], "file/".$location);
    echo '<embed src="file/' . $location . '" width="100%" height="100%" class="img-thumbnail" style="margin-top:10px"/>';
    echo '
        <form action="kompres.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="' . $location . '" name="file-compress">
            <button class="btn btn-info btn-block" name="compress">Compress</button>
        </form>
    ';
}
