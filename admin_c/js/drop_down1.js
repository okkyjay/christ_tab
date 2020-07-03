function dropdownlist(listindex)
{

document.formname.subcategory.options.length = 0;
	switch (listindex)
	{
	
		case "VC Office" :
		    document.formname.subcategory.options[0]=new Option("--select--","");
			document.formname.subcategory.options[1]=new Option("VC","VC");
			document.formname.subcategory.options[2]=new Option("Deputy VC","Deputy VC");
			document.formname.subcategory.options[3]=new Option("Registrar","Registrar");
			document.formname.subcategory.options[4]=new Option("Bursar","Bursar");
			document.formname.subcategory.options[5]=new Option("CLO","CLO");
	break;
	
		case "Computer Science" :
		    document.formname.subcategory.options[0]=new Option("--select--","");
			document.formname.subcategory.options[1]=new Option("Mr. Ajayi","Mr. Ajayi");
			document.formname.subcategory.options[2]=new Option("Dr. Afolabi","Dr. Afolabi");
			document.formname.subcategory.options[3]=new Option("Mr. Bello","Mr. Bello");
			document.formname.subcategory.options[4]=new Option("Mr. Aranuwa","Mr. Aranuwa");
			document.formname.subcategory.options[5]=new Option("Mr. Oguniye","Mr. Oguniye");
	
	break;
	
		case "Mathematics" :
		    document.formname.subcategory.options[0]=new Option("--select--","");
			document.formname.subcategory.options[1]=new Option("College Books","College Books");
			document.formname.subcategory.options[2]=new Option("Engineering","Engineering");
			document.formname.subcategory.options[3]=new Option("Magazines","Magazines");
			document.formname.subcategory.options[4]=new Option("Medicine","Medicine");
			document.formname.subcategory.options[5]=new Option("References","References");
			
	break;
	
		default:
		document.formname.subcategory.options[0]=new Option("--select--","");
	
	}
return true;
}