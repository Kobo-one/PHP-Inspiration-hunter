<?php
    include_once("Db.class.php");
    include_once("Post.class.php");

    class Image{
        private $fileName;
        private $fileSize;
        private $fileTmp;
        private $fileType;
        private $fileDir;
        private $fileExt;
        
        
    /*Setters*/
        
    public function setFileName($fileName){
            $this->fileName = $fileName;
            return $this;
    }
        
    public function setFileSize($fileSize){
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
        
    function compress_image($source_url, $destination_url, $quality){
        $info = getimagesize($source_url);
            
        if ($info['mime'] == 'image/jpeg'){
            $image = imagecreatefromjpeg($source_url);
            }

            elseif ($info['mime'] == 'image/png'){
            $image = imagecreatefrompng($source_url);
            }

            imagejpeg($image, $destination_url, $quality);
            return $destination_url;
        }
        
    }


?>