<?php
/**
*	upload helper
*	@author ParkerRo 2017
*/
class uploadHelper {

	private $file;
	private $filename;
	private $target_path;
	private $Img_type = array('jpg','png');
	private $return_status = array('status'=>true,'msg'=>'Upload OK');

	public  $Img_ext_type  = array();
	public  $file_size = 1048576; #1MB
	public  $file_exists = true; 


/**
*	imageUpload
*	@param file $_FILES["file"] 
*	@param filename  filename u want to name 
*	@param target_path path of this file 
*	@return boolean status 
*	@return string msg 
*/
	public function imageUpload($file,$filename,$target_path)
	{
		$this->file = $file;
		$this->filename = $filename;
		$this->target_path = $target_path;

		## Check file is OK?
		if($this->file['error'] != 0){
			$this->return_status = array('status'=>false,'msg'=>'Upload to tmp error - '.$this->file['error']);
		}
		## Check file type?
		if(!$this -> checkFileType()){
			$this->return_status = array('status'=>false,'msg'=>'File type error');
		}
		## Check this file size
		if($this->file['size'] > $this->file_size){
			$this->return_status = array('status'=>false,'msg'=>'File size is limited in '.($this->file_size)/1024 .'Kb');
		}
		## Check file exist
		if (file_exists($this->target_path.$this->filename) && $this->file_exists == true){
			$this->return_status = array('status'=>false,'msg'=>'File already exist. ');
		}
		## All of the check is OK?
		if($this->return_status['status']==false){
			return $this->return_status; exit();
		}


		## Process upload file
		if(!move_uploaded_file($this->file["tmp_name"],$this->target_path.$this->filename))
		{
			$this->return_status = array('status'=>false,'msg'=>'File moving prossess error.');
		}

		return $this->return_status;
	}

	private function checkFileType()
	{
		$imageFileType = pathinfo($this->file['name'],PATHINFO_EXTENSION);
		return in_array(strtolower($imageFileType),array_merge($this->Img_type,$this->Img_ext_type));
	}

}