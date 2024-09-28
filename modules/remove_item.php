<?php
$parentDir = Load::getParentDir();
$load = new Load($parentDir);

$fileName = filter_input(INPUT_GET, 'fileName', FILTER_SANITIZE_SPECIAL_CHARS);


if (!empty($fileName)) {
    $path = _DATA_DIR . $parentDir . '/' . $fileName;

    if ($load->isType($path) == 'file') {
        Make::deleteFile($parentDir, $fileName);
    } else {
        Make::deleteFolder($parentDir, $fileName);
    }
} else {
    $msg = 'Tên file hoặc folder không được để trống';
}

if (!empty($msg)) {
?>
    <div class="alert alert-danger text-center">
        <?php echo $msg ?>
    </div>
<?php
} else {
    redirect('?path=' . $parentDir);
}
