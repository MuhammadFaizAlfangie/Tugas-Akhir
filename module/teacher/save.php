<?php
if (isset($_POST['save'])) {
    include_once('config.php');
    include('func/upload.php');

    $nip = $_POST['nip'];
    $name = $_POST['name'];
    $pob = $_POST['pob'];
    $dob = $_POST['dob'];
    $wa = $_POST['wa'];
    $subject_id = $_POST['subject_id'];
    $location = $_FILES['foto']['tmp_name'];
    $filename = $_FILES['foto']['name'];
    $filetype = $_FILES['foto']['type'];

    if (empty($location)) {
        $sql = "INSERT INTO teachers SET nip='$nip', name='$name', pob='$pob', dob='$dob', wa='$wa', subject_id='$subject_id'";
    } else {
        $folder = "assets/dist/img/teachers/";
        $size = 100;
        UploadFoto($filename, $folder, $size);
        $sql = "INSERT INTO teachers SET nip='$nip', name='$name', pob='$pob', dob='$dob', wa='$wa', photo='$filename', subject_id='$subject_id'";
    }
    if (mysqli_query($config, $sql)) {
        echo '<script>window.location.href="?m=teacher&s=view"</script>';
    } else {
        echo '<script>alert("Data gagal disimpan!"); window.location.href="?m=teacher&s=add"</script>';
    }
} else {
    echo '<script>window.history.back()</script>';
}