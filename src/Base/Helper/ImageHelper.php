<?php

namespace App\Base\Helper;

use Slim\Http\UploadedFile;

class ImageHelper
{

    public function getExt($file)
    {
        $image_extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
        return $image_extension;
    }

    public function moveUploadedFile($directory, UploadedFile $file)
    {
        $basename = bin2hex(random_bytes(8));
        $extension = $this->getExt($file);
        $filename = sprintf('%s.%0.8s', $basename, $extension);
        $file->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
        $data = [
            'name' => $filename,
            'ext' => $extension
        ];
        return $data;
    }

}
