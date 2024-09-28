<?php
$parentDir = Load::getParentDir();
$load = new Load($parentDir);

$dataScan = $load->scanDir($parentDir);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $old = filter_input(INPUT_POST, 'old', FILTER_SANITIZE_SPECIAL_CHARS);
    Make::rename($parentDir, $old, $name);
    redirect('?=path');
}

/* echo '<pre>';
print_r($_SERVER);
echo '</pre>'; */

?>
<form action="" method="post" id="form-filemanager">
    <table id="dataTable">
        <thead>
            <tr>
                <th>
                    <div class="text-center"><input type="checkbox" id="checkAll"></div>
                </th>
                <th class="text-center">Tên</th>
                <th class="text-center">Dung lượng</th>
                <th class="text-center">Cập nhật cuối</th>
                <th class="text-center">Quyền</th>
                <th class="text text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $load->back();  // quay lại trang trước
            if (!empty($dataScan)):
                foreach ($dataScan as $item):
                    $path = $load->getPath($item);

                    if ($load->isType($path) == 'folder') {
                        $targetPath = '?path='.urlencode(str_replace(_DATA_DIR . '/', '', $path));
                    } else {
                        //$targetPath = '';
                        //$targetPath = '?path='.urlencode(str_replace(_DATA_DIR . '/', '', $path));
                        //$targetPath = 'view_file.php?path='.json_encode($targetPath);
                        $targetPath = '?module=view_file&path='.urlencode(str_replace(_DATA_DIR . '/', '', $path));
                    }

                    $dataTypeArr = [
                        'type' => $load->isType($path),
                        'name' => $item
                    ];
            ?>
                    <tr>
                        <td>
                            <div class="text-center"><input type="checkbox" name="" class="check-item"></div>
                        </td>
                        <td class=""><a href="<?php echo $targetPath ?>"><?php echo $load->getTypeIcon($item) . ' ' . $item ?></a></td>
                        <td class="text-center"><?php echo $load->getSize($item, 'KB') ?></td>
                        <td class="text-center"><?php echo $load->getTimeModify($item) ?></td>
                        <td class="text-center"><?php echo $load->getPermisson($item) ?></td>
                        <td class="text-end">
                            <?php if ($load->isType($path) == 'file'): ?>
                                <a href="<?php echo $path ?>" class="btn btn-primary mx-1" target="_blank"><i class="fas fa-eye"></i></i></a>
                                <a href="?module=dowload_file&path=<?php echo $path ?>" class="btn btn-primary mx-1"><i class="fas fa-download"></i></a>
                            <?php endif; ?>
                            <a href="?module=remove_item&type=action&path=<?php echo $parentDir ?>&fileName=<?php echo urlencode($item) ?>" class="btn btn-primary mx-1" onclick="return confirm('Bạn có chắc chắn?')"><i class="fas fa-trash"></i></a>
                            <a href="#" class="btn btn-primary mx-1 edit-action" data-type='<?php echo json_encode($dataTypeArr) ?>'><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-primary mx-1"><i class="fas fa-copy"></i></a>
                            <a href="#" class="btn btn-primary mx-1 get-link" data-link="<?php echo getUrl($targetPath); ?>"><i class="fas fa-link"></i></a>
                        </td>
                    </tr>
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
    <input type="hidden" name="name" value="">
    <input type="hidden" name="old" value="">
</form>