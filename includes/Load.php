<?php
class Load
{
    private $parentPath = null;
    public function __construct($parentPath) {
        if (!empty($parentPath)) {
            $this->parentPath = $parentPath != '.' ? _DATA_DIR.'/'.$parentPath : _DATA_DIR;
        }
    }
    // Lấy ra tất cả file, folder có trong đường dẫn
    public function scanDir($parentDir = '')
    {
        if (empty($parentDir)) {
            $path = _DATA_DIR;
        } else {
            $path = _DATA_DIR . '/' . $parentDir;
        }

        $this->parentPath = $path;

        $dataScan = scandir($path);

        if (isset($dataScan[0])) unset($dataScan[0]);
        if (isset($dataScan[1])) unset($dataScan[1]);

        return $dataScan;
    }
    // Kiểm tra đường dẫn là file hay folder
    public function isType($path)
    {
        if (is_dir($path)) {
            return 'folder';
        }
        return 'file';
    }
    // Lấy đường dẫn của 1 file
    public function getPath($fileName)
    {
        $path = $this->parentPath . '/' . $fileName;

        return $path;
    }
    // Trả về icon tương ứng với type
    public function getTypeIcon($fileName)
    {
        $path = $this->getPath($fileName);

        if ($this->isType($path) == 'folder') return '<i class="far fa-folder"></i>';

        return '<i class="far fa-file"></i>';
    }
    // Trả về dung lượng của 1 file
    public function getSize($fileName, $unit = '')
    {
        $path = $this->getPath($fileName);

        if ($this->isType($path) == 'file') {
            if (file_exists($path)) {
                $size = filesize($path);
                return round($size / 1024, 2) . ' ' . $unit;
            }
        }
        return 'Thư mục';
    }
    // Trả về thời gian cập nhật cuối cùng
    public function getTimeModify($fileName, $format = 'd/m/Y H:i:s')
    {
        $path = $this->getPath($fileName);

        if (file_exists($path)) {
            $time = filemtime($path);
            if (!empty($time)) {
                $date = date($format, $time);
                return  $date;
            }
            return '';
        }
    }
    // Trả về quyền của 1 file hoặc folder
    public function getPermisson($fileName)
    {
        $path = $this->getPath($fileName);

        if (file_exists($path)) {
            $result = fileperms($path);
            $result = sprintf('%o', $result);
            $result = substr($result, -4);

            return $result;
        }
    }
    // Lấy đường dẫn
    public static function getParentDir()
    {
        $parentDir = '';

        if (!empty($_GET['path'])) {
            $parentDir = urldecode($_GET['path']);
        }

        return $parentDir;
    }
    // Quay lại
    public function back()
    {
        $parentDir = self::getParentDir();

        if (!empty($parentDir)) {
            echo '<tr>
                    <td></td>
                    <td colspan="5">
                        <a class="back" href="#" onclick="event.preventDefault();window.history.back();">...</a>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
        }
    }
    // 
    public function getFileName($path) {
        return basename($path);
    }
    //
    public function getFileType ($fileName) {
        $path = $this->getPath($fileName);

        if ($this->isType($path)!=='folder') {
            if (file_exists($path)) {
                $size = filesize($path);
                return mime_content_type($path);
            }
        }

        return '';
    }
    //
    public function getFileNameUrl($fileName) {
        $path = $this->getPath($fileName);
        $path = preg_replace('~^./~', '', $path);
        return _BASE_URL.$path;
    }
    //
    public function isFileType($fileName, $type) {
        return strpos($this->getFileType($fileName), $type) !== false;
    }
}
