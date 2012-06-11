<?php
/**
 * Created by JetBrains PhpStorm.
 * User: annabelle
 * Date: 10/06/12
 * Time: 12:36
 * To change this template use File | Settings | File Templates.
 */


require_once 'Erreur.php';

final class Resizer
{
    private $destinationFolder;
    private $imgWidth;
    private $imgHeight;

    function __construct($destinationFolder, $imgWidth, $imgHeight)
    {
        $this->destinationFolder = $destinationFolder;
        $this->imgHeight = $imgHeight;
        $this->imgWidth = $imgWidth;
    }

    public function resizeImage($file) // file = './img/mon_image.png'
    {
        $imgInfo = getimagesize($file);
        $imgFullPath = $file;
        $resizedFileName = pathinfo($file, PATHINFO_FILENAME) . '_RESIZED_.' . pathinfo($file, PATHINFO_EXTENSION);

        switch ($imgInfo[2])
        {
            case IMAGETYPE_JPEG:
                $resource = imagecreatefromjpeg($imgFullPath);
                break;

            case IMAGETYPE_GIF:
                $resource = imagecreatefromgif($imgFullPath);
                break;

            case IMAGETYPE_PNG:
                $resource = imagecreatefrompng($imgFullPath);
                break;

            default:
                return $file; // on le resize pas
        }

        if ($resource)
        {
            $factor = 200 / $imgInfo[1]; // 200 = hauteur en px souhaitée
            $factor = $factor < 1 ? $factor : 1; //Prévention contre l'agrendissement des images
            $new_width = $imgInfo[0] * $factor;
            $new_height = $imgInfo[1] * $factor;

            if ($image = imagecreatetruecolor($new_width, $new_height))
            {
                if (imagecopyresized($image, $resource, 0, 0, 0, 0, $new_width, $new_height, $imgInfo[0], $imgInfo[1]))
                {
                    switch ($imgInfo[2])
                    {
                        case IMAGETYPE_JPEG:
                            imagejpeg($image, $this->destinationFolder . $resizedFileName);
                            return $this->destinationFolder . $resizedFileName;

                        case IMAGETYPE_GIF:
                            imagegif($image, $this->destinationFolder . $resizedFileName);
                            return $this->destinationFolder . $resizedFileName;

                        case IMAGETYPE_PNG:
                            imagepng($image, $this->destinationFolder . $resizedFileName);
                            return $this->destinationFolder . $resizedFileName;

                        default:
                            return $file; // On ne devrais jamais passer par ici mais on ne sait jamais
                    }
                }
                else
                {
                    Erreur::erreurCopieImage();
                }
            }
            else
            {
                Erreur::erreurCreationImage();
            }
        }
    }
}
