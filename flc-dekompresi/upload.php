
<?php
if ($_FILES["file"]["name"] != '') {
$test = explode('.', $_FILES["file"]["name"]);
$ext = end($test);
$name = $_FILES["file"]["name"];
$location =  $name;
move_uploaded_file($_FILES["file"]["tmp_name"], "file/".$location);
echo file_get_contents('file/'.$location);
echo '
 <form action="dekompres.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" value="' . $location . '" name="file-decompress">
        <button class="btn btn-info btn-block" name="decompress" style="width:15%;box-shadow: 0 5px 10px 0 rgba(0,0,0,0.2), 0 7px 20px 0 rgba(0,0,0,0.19);padding: 10px 30px;font-size: 15px;    background-color: #2748B2;border: none;">Dekompres
        </button>
    </form>
    ';


}
?>

