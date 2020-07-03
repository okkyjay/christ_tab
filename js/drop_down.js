function dropdownlist(listindex)
{

document.formname.subcategory.options.length = 0;
	switch (listindex)
	{
	
		case "VC Office" :
		    document.formname.subcategory.options[0]=new Option("Select Sub-Category","");
			document.formname.subcategory.options[1]=new Option("Air-Conditioners/Coolers","Air-Conditioners/Coolers");
			document.formname.subcategory.options[2]=new Option("Audio/Video","Audio/Video");
			document.formname.subcategory.options[3]=new Option("Beddings","Beddings");
			document.formname.subcategory.options[4]=new Option("Camera","Camera");
			document.formname.subcategory.options[5]=new Option("Cell Phones","Cell Phones");
	break;
	
		case "Computer Science" :
		    document.formname.subcategory.options[0]=new Option("Select Sub-Category","");
			document.formname.subcategory.options[1]=new Option("Colleges","Colleges");
			document.formname.subcategory.options[2]=new Option("Institutes","Institutes");
			document.formname.subcategory.options[3]=new Option("Schools","Schools");
			document.formname.subcategory.options[4]=new Option("Tuitions","Tuitions");
			document.formname.subcategory.options[5]=new Option("Universities","Universities");
	
	break;
	
		case "Mathematics" :
		    document.formname.subcategory.options[0]=new Option("Select Sub-Category","");
			document.formname.subcategory.options[1]=new Option("College Books","College Books");
			document.formname.subcategory.options[2]=new Option("Engineering","Engineering");
			document.formname.subcategory.options[3]=new Option("Magazines","Magazines");
			document.formname.subcategory.options[4]=new Option("Medicine","Medicine");
			document.formname.subcategory.options[5]=new Option("References","References");
			
	break;
	
		default:
		document.formname.subcategory.options[0]=new Option("Select Sub-Category","");
	
	}
return true;
}