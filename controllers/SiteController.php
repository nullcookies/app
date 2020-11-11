<?php

class SiteController
{

    public function actionIndex()
    {
        require_once(ROOT.'/views/site/index.php');
        return true;
    }


    public function actionUpload()
    {
        $data = [];
        if (isset($_POST['image_upload']) && !empty($_FILES['images'])) {

            $image = $_FILES['images'];
            $allowedExts = array("jpeg", "jpg", "png");

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }


            //create directory if not exists
            if (!file_exists('images')) {
                mkdir('images', 0777, true);
            }
            $image_name = $image['name'];
            //get image extension
            $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            //assign unique name to image
            $name = time().'.'.$ext;
            //$name = $image_name;
            //image size calcuation in KB
            $image_size = $image["size"] / 1024;
            $image_flag = true;
            //max image size
            $max_size = 512;
            if (in_array($ext, $allowedExts) && $image_size < $max_size) {
                $image_flag = true;
            } else {
                $image_flag = false;
                $data['error'] = 'Maybe '.$image_name.' exceeds max '.$max_size.' KB size or incorrect file extension';
            }

            if ($image["error"] > 0) {
                $image_flag = false;
                $data['error'] = '';
                $data['error'] .= '<br/> '.$image_name.' Image contains error - Error Code : '.$image["error"];
            }

            if ($image_flag) {
                move_uploaded_file($image["tmp_name"], "images/".$name);
                $src = "images/".$name;
                $dist = "images/thumbnail_".$name;
                $data['success'] = $thumbnail = 'thumbnail_'.$name;
                $this->thumbnail($src, $dist, 200);

                $image = R::dispense('images');

                $image->original_image = $name;
                $image->thumbnail_image = $thumbnail;
                $image->user_id = $_SESSION['user']['id'];

                $data['id'] = R::store($image);
            }

            echo json_encode($data);

        } else {
            $data[] = 'No Image Selected..';
        }
    }

    public function actionIndexupload()
    {

    }

    public function actionDelete()
    {
        if (isset($_POST['deleteId'])) {
            $deleteId = $_POST['deleteId'];

            $sql = R::getRow('select * from images where id = :id and user_id = :user_id',
              [':id' => $deleteId, ':user_id' => $_SESSION['user']['id']]);

            $filePath = 'images/'.$sql['original_image'];

            R::exec('DELETE FROM images WHERE id = :id AND user_id = :user_id',
              [':id' => $deleteId, ':user_id' => $_SESSION['user']['id']]);
            unlink($filePath);

        }
    }

    public function actionIndexdelete()
    {

    }

    public function actionFetchData()
    {
        $userId = User::checkLogged();
        $images = R::getAll('select * from images where user_id = :user_id',
          [':user_id' => $userId]);

        echo json_encode($images);

    }

    public function actionIndexfetch_data()
    {

    }

    public function actiongetImage()
    {
        $file = file_get_contents(__DIR__.'/../images/' . $_GET['img'], true);
        echo $file;
    }

    public function actionIndexget_image()
    {

    }

    private function thumbnail($src, $dist, $dis_width = 100)
    {

        $img = '';
        $extension = strtolower(strrchr($src, '.'));
        switch ($extension) {
            case '.jpg':
            case '.jpeg':
                $img = @imagecreatefromjpeg($src);
                break;
            case '.gif':
                $img = @imagecreatefromgif($src);
                break;
            case '.png':
                $img = @imagecreatefrompng($src);
                break;
        }
        $width = imagesx($img);
        $height = imagesy($img);


        $dis_height = $dis_width * ($height / $width);

        $new_image = imagecreatetruecolor($dis_width, $dis_height);
        imagecopyresampled($new_image, $img, 0, 0, 0, 0, $dis_width, $dis_height, $width, $height);


        $imageQuality = 100;

        switch ($extension) {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($new_image, $dist, $imageQuality);
                }
                break;

            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($new_image, $dist);
                }
                break;

            case '.png':
                $scaleQuality = round(($imageQuality / 100) * 9);
                $invertScaleQuality = 9 - $scaleQuality;

                if (imagetypes() & IMG_PNG) {
                    imagepng($new_image, $dist, $invertScaleQuality);
                }
                break;
        }
        imagedestroy($new_image);
    }

    /*    public function __call($function, $args)
        {
            header('HTTP/1.0 404 Not Found');
            readfile(ROOT.'/views/site/err404.html');
            exit();
        }*/
}