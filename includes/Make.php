<?php
class Make {
    // Thêm mới file
    public static function createFile($parentDir, $fileName, $data='') {
        $path = _DATA_DIR.'/'.$parentDir.'/'.$fileName;
        file_put_contents($path, $data);    // câu lệnh tạo file
    }
    // Thêm mới thư mục
    public static function createFolder($parentDir, $folderName) {
        $path = _DATA_DIR.'/'.$parentDir.'/'.$folderName;
        mkdir($path);
    }
    // Đổi tên
    public static function rename($parentDir, $old, $name) {
        $oldPath = _DATA_DIR.'/'.$parentDir.'/'.$old;
        $newPath = _DATA_DIR.'/'.$parentDir.'/'.$name;
        rename($oldPath, $newPath);
    }
    // Xóa file
    public static function deleteFile ($parentDir, $fileName) {
        $path = _DATA_DIR.'/'.$parentDir.'/'.$fileName;
        if (file_exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }
    // Xóa thư mục
    public static function deleteFolder ($parentDir, $name) {
        $load = new Load;
        $path = _DATA_DIR.'/'.$parentDir.'/'.$name;
        if (is_dir($path)) {
            
            $dataArr  = $load->scanDir($parentDir.'/'.$name);
            
            if (!empty($dataArr)) {
                foreach ($dataArr as $item) {
                    $pathChildren = $parentDir.'/'.$name.'/'.$item;
                    if ($load->isType(_DATA_DIR.$pathChildren)=='file') {
                        // Xóa file
                        self::deleteFile(dirname($pathChildren), $item);
                    }
                    else {
                        self::deleteFolder($parentDir.'/'.$name, $item);
                    }
                }
            }
            
            rmdir($path);
            return true;
        }
        return false;
    }
}