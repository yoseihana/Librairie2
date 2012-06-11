<?php

final class Uploader
{
    private $destinationFolder;
    private $maximumFileSize;
    private $validExtensions;

    /**
     * TODO
     * @param $destinationFolder
     * @param array $validExtensions
     * @param int $maximumFileSize - Valeur par défaut 10485760 = 1024 * 1024 * 10 = 10Mo
     */
    public function __construct($destinationFolder, array $validExtensions = array(), $maximumFileSize = 10485760)
    {
        $this->destinationFolder = $destinationFolder;
        $this->validExtensions = $validExtensions;
        $this->maximumFileSize = $maximumFileSize;
    }

    /**
     * TODO
     * @param $file
     * @return bool
     */
    public function isFileExists($file)
    {
        return array_key_exists($file, $_FILES);
    }

    /**
     * TODO
     * @param $file
     * @return bool
     */
    public function isValidExtension($file)
    {
        if (!$this->isFileExists($file))
        {
            return false;
        }

        if (empty($this->validExtensions))
        {
            return true;
        }

        $fileExtension = strtolower(pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION));
        return in_array($fileExtension, $this->validExtensions);
    }

    /**
     * TODO
     * @param $file
     * @return bool
     */
    public function isValidFileSize($file)
    {
        if (!$this->isFileExists($file))
        {
            return false;
        }

        return filesize($_FILES[$file]['tmp_name']) <= $this->maximumFileSize;
    }

    /**
     * TODO
     * @param $file
     * @return bool
     */
    public function getErrorCode($file)
    {
        if (!$this->isFileExists($file))
        {
            return false;
        }

        return $_FILES[$file]['error'];
    }

    /**
     * TODO
     * @param $file
     * @param null $fileName
     * @return bool|mixed|string
     */
    public function save($file, $fileName = NULL)
    {
        if ($this->isFileExists($file) && $this->isValidExtension($file) && $this->isValidFileSize($file))
        {
            $finalFileName = pathinfo(($fileName) ? $fileName : $_FILES[$file]['name'], PATHINFO_FILENAME);
            $finalFileName = $finalFileName . '.' . pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
            if (move_uploaded_file($_FILES[$file]['tmp_name'], $this->destinationFolder . $finalFileName))
            {
                return $finalFileName;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * TODO
     * @return mixed
     */
    public function getDestinationFolder()
    {
        return $this->destinationFolder;
    }

    /**
     * TODO
     * @return int
     */
    public function getMaximumFileSize()
    {
        return $this->maximumFileSize;
    }

    /**
     * TODO
     * @return array
     */
    public function getValidExtensions()
    {
        return $this->validExtensions;
    }
}