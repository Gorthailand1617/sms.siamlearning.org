<?php
/**
 * @filesource modules/edocument/filedownload.php
 *
 * @copyright 2016 Goragod.com
 * @license https://www.kotchasan.com/license/
 *
 * @see https://www.kotchasan.com/
 */
// session
@session_cache_limiter('none');
@session_start();
// datas
if (isset($_GET['id']) && isset($_SESSION[$_GET['id']])) {
    $file = $_SESSION[$_GET['id']];
    if (is_file($file['file'])) {
        // ดาวน์โหลดไฟล์
        if ($file['name'] != '') {
            header('Content-Disposition: attachment; filename="'.$file['name'].'"');
        } else {
            header('Content-Disposition: inline;');
            header('Content-Type: '.$file['mime']);
        }
        header('Content-Description: File Transfer');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '.$file['size']);
        readfile($file['file']);
        exit;
    }
}
header('HTTP/1.0 404 Not Found');
