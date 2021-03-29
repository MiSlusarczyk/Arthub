<?php

class Image
{
    public function cropImage($originalFileName, $crropedFileName, $maxWidth, $maxHeight)
    {
        if(file_exists($originalFileName))
        {
            $originalImage = imagecreatefromjpeg($originalFileName);

            $originalWidth = imagesx($originalImage);
            $originalHeight = imagesy($originalImage);

            if($originalWidth < $originalHeight)
            {
                $ratio = $maxWidth/$originalWidth;
                $newWidth = $maxWidth;
                $newHeight = $originalHeight*$ratio;
            }
            else
            {
                $ratio = $maxHeight/$originalHeight;
                $newHeight = $maxHeight;
                $newWidth = $originalWidth*$ratio;
            }
        }

        if($maxWidth!=$maxHeight)
        {
            if($maxHeight > $maxWidth)
            {
                if($maxHeight > $newHeight)
                {
                    $adjustment = ($maxHeight/ $newHeight);
                }
                else
                {
                    $adjustment = ($newHeight/ $maxHeight);
                }

                $newWidth = $newWidth*$adjustment;
                $newHeight = $newHeight*$adjustment;
            }
            else
            {
                if($maxWidth > $newWidth)
                {
                    $adjustment = ($maxWidth/ $newWidth);
                }
                else
                {
                    $adjustment = ($newWidth/ $maxWidth);
                }

                $newWidth = $newWidth*$adjustment;
                $newHeight = $newHeight*$adjustment;
            }
        }

        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

       imagedestroy($originalImage);

       if($maxWidth!=$maxHeight)
       {
            if($maxWidth > $maxHeight)
            {
                $diff = ($newHeight - $maxHeight);
                if($diff<0)
                {
                    $diff = $diff*-1;
                }
                $y = round($diff/2);
                $x = 0;
            }
            else
            {
                $diff = ($newWidth - $maxWidth);
                if($diff<0)
                {
                    $diff = $diff*-1;
                }
                $x = round($diff/2);
                $y = 0;
            }
       }
       else
       {
            if($newHeight > $newWidth)
            {
                $diff = ($newHeight - $newWidth);
                $y = round($diff/2);
                $x = 0;
            }
            else
            {
                $diff = ($newWidth - $newHeight);
                $x = round($diff/2);
                $y = 0;
            }
        }

        $newCroppedImage = imagecreatetruecolor($maxWidth, $maxHeight);
        imagecopyresampled($newCroppedImage, $newImage, 0, 0, $x, $y, $maxWidth, $maxHeight, $maxWidth, $maxHeight);
        imagedestroy($newImage);
        imagejpeg($newCroppedImage, $crropedFileName,90);
        imagedestroy($newCroppedImage);
    }

    public function generateFileName($length)
    {
        $array = array(0,1,2,3,4,5,6,7,8,9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'w', 'q', 'v', 'x', 'z');
        $text = "";
        for($i = 0; $i <$length; $i++)
        {
            $rand = rand(0,30);
            $text .= $array[$rand];
        }

        $text = $text.".jpg";

        return $text;
    }
}

?>