<?php
function processUpload($fieldName,$desFileName,$uploadPath, $max_file)
{
	if(!empty($_FILES)) {
		$userfile_name = $_FILES[$fieldName]['name'];
		$userfile_tmp = $_FILES[$fieldName]['tmp_name'];
		$userfile_size = $_FILES[$fieldName]['size'];
		$filename = basename($_FILES[$fieldName]['name']);
		$file_ext = substr($filename, strrpos($filename, '.') + 1);
		
		//Only process if the file is a JPG and below the allowed limit
		if(!empty($_FILES[$fieldName]))
		{
			switch($_FILES[$fieldName]['error'])
			{
				case 0:
					if (($file_ext!="jpg" && $file_ext!="gif" && $file_ext!="jpeg" && $file_ext!="png" && $file_ext!="zip" && $file_ext!="rar" && $file_ext!="7z" && $file_ext!="doc" && $file_ext!="pdf" && $file_ext!="xls" && $file_ext!="xlsx" && $file_ext!="pptx" && $file_ext!="ppt" && $file_ext!="cdr" && $file_ext!="pad" && $file_ext!="docx") && ($userfile_size > $max_file))
						$error = 'ONLY image files under 3MB are accepted for upload';
					else
						$error = '';
					break;
				case 1:
					$error= "ONLY image files under 3MB are accepted for upload";
					break;
				case 2:
					$error= "ONLY image files under 3MB are accepted for upload";
					break;
				case 3:
					$error= "File was partially uploaded";
					break;
				case 4:
					$error= "No file was uploaded";
					break;
			}
		}
		
		$imagedir = $uploadPath;
		$image = $desFileName.'.'.$file_ext; //substr(md5(uniqid()),1,8).'.'.$file_ext;
		$imagepath = $imagedir.$image;
		
		if (strlen($error)==0)
		{
			if (isset($_FILES[$fieldName]['name']))
			{
				if(file_exists($imagepath))
				{
					unlink($imagepath);
					$imagepath = $imagedir.$desFileName.substr(md5(uniqid()),1,8).$file_ext;
				}
				
				if (move_uploaded_file($userfile_tmp, $imagepath))
					$json = array('status' => 'success', 'response' => $image);
				else
					$json = array('status' => 'error', 'response' => 'Error Uploading File');
			}
		}
		else
		{
			$json = array('status' => 'error', 'response' => strip_tags($error));
		}
		
		return $json;
	}
	else
	{
		return '';
	}
}
?>