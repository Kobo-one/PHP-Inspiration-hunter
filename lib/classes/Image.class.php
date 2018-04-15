<?php
    include_once("Db.class.php");

    class Image{
        private $fileName;
        private $fileSize;
        private $fileTmp;
        private $fileType;
        private $fileDir;
        private $extParts;
        private $fileExt;
        
    /*Setters*/
        
    public function setFileName($fileName){
            $this->fileName = $fileName;
            return $this;
    }
        
    public function setFileSize($fileSize){
        if( $fileSize > 2097152 ){
            throw new Exception("Image is bigger than 2MB.");
        }
            $this->fileSize = $fileSize;
            return $this;
    }
      
    public function setFileTmp($fileTmp){
            $this->fileTmp = $fileTmp;
            return $this;
    }   
        
    public function setFileType($fileType){
            $this->fileType = $fileType;
            return $this;
    }
        
    public function setFileDir($fileDir){
            $this->fileDir = $fileDir;
            return $this;
    }
        
    public function setFileExt($fileExt){
        $expensions = array("jpeg","jpg","png");
        if(in_array($fileExt, $expensions) === false){
            throw new Exception("Please choose a JPEG or PNG image.");
        }
            $this->fileExt = $fileExt;
            return $this;
    }
        
    /*Getters*/
    
    public function getFileName()
    {
        return $this->fileName;
    }
        
    public function getFileSize()
    {
        return $this->fileSize;
    }
        
    public function getFileTmp()
    {
        return $this->fileTmp;
    }
        
    public function getFileType()
    {
        return $this->fileType;
    }
        
    public function getFileDir()
    {
        return $this->fileDir;
    }
        
    public function getFileExt()
    {
        return $this->fileExt;
    }
    
        //compress uploaded image
    function compressImage($fileDir, $imageCompress){
        $info = getimagesize($fileDir);
            
        if ($info['mime'] == 'image/jpeg'){
            $fileDir = imagecreatefromjpeg($fileDir);
            imagejpeg($fileDir, $imageCompress, 75);
            }

            elseif ($info['mime'] == 'image/png'){
            $fileDir = imagecreatefrompng($fileDir);
            imagepng($fileDir, $imageCompress, 6);
            }

            return $imageCompress;
    }
        
    }


?>