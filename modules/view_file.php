<?php
$parentDir = dirname(Load::getParentDir());
$load = new Load($parentDir);

$path = filter_input(
    INPUT_GET,
    'path',
    FILTER_SANITIZE_SPECIAL_CHARS
);

if (!empty($path)) {
    $fileName = $load->getFileName($path);
    echo "<h2>FILE: \"$fileName\"</h2>";
    echo '<p>Full Path: ' . $load->getPath($fileName) . '</p>';
    echo '<p>File size: ' . $load->getSize($fileName, 'KB') . '</p>';
    echo '<p>MME-type: ' . $load->getFileType($fileName) . '</p>';
    echo '<ul class="list-unstyled d-flex gap-2">
            <li><a href="?module=dowload_file&path=' . $load->getPath($fileName) . '"><i class="fas fa-cloud-download-alt"></i>Dowload</a></li>
            <li><a href="' . $load->getPath($fileName) . '" target="_blank"><i class="fas fa-external-link-alt"></i>Open</a></li>
            <li><a href="#" onclick="event.preventDefault(); window.history.back()"><i class="fas fa-arrow-circle-left"></i>Back</a></li>
        </ul>';
    if ($load->isFileType($fileName, 'officedocument') || $load->isFileType($fileName, 'pdf') || $load->isFileType($fileName, 'image')) {
        echo '<iframe style="width: 100%; height: 600px" src="https://docs.google.com/gview?url='.$load->getFileNameUrl($fileName).'&embedded=true"></iframe>';
    }
    else if ($load->isFileType($fileName, 'text')) {
        $sourcePath = $load->getPath($fileName);
        $cachePath = './caches/'.md5(uniqid());
        $check = false;
        if (!empty($_COOKIE['view_file'])) {
            $file = json_decode($_COOKIE['view_file'], true);
            if (!empty($file[$sourcePath])) {
                $check = true;
                $cachePath = $file[$sourcePath];
            }
        }

        if (!$check || !file_exists($cachePath)) {
            copy($sourcePath, $cachePath);
        }
        
        echo '<pre><code class="">';
        $contentFile = file_get_contents($cachePath);
        $contentFile = htmlentities($contentFile);
        echo $contentFile;
        echo '</code></pre>';
        
        $file = [
            $sourcePath => $cachePath
        ];
        setcookie('view_file', json_encode($file), 0, '/');
    }
    else {
        echo '<p>Không có xem trước</p>';
    }
}
