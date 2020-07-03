<?php
	               $file = $_GET['file'];  //for the “file” to be included in the function
		       $path = $_GET['folder']."/".$file;
		       $folder = $_GET['folder'];

		       if( $file == "" ) //if there is no file or file not found or
											//NULL then it executes the next lines of codes. 
			{
			echo "<html><body>No file has been found</body></html>"; 
											//outputs this line of code						
			exit;    						//terminates execution of the code in the program
			} elseif ( ! file_exists( $path ) )      // if the filename chosen exists then 
											//		this code will execute the next lines of codes
			{
			echo "<html><body>please choose a file to Download</body></html>";
			exit;  	 						//terminates execution of the code in the program
			}
			elseif($folder=="")
			{
			        echo "<html><body>ERROR</body></html>";
				exit;
			}

			header("Content-Type: application/force-download"); // this code identifies the type
											// of media the user chooses, if he choose the 
											//audio format then it identifies according to 
											//the .mp3 format.
			header("Content-Disposition: attachment; filename=\"".basename($file)."\";" );  
									//this line of code suggests the filename that we want to saved.
			readfile("$path");	// this line of code does the reading and interpreting 
								//of file so that it will be viewed in the web browser
			exit();				//terminates execution of the code in the program
			

?>





