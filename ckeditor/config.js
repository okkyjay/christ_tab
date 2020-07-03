/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.toolbar = 'composeMail';
 
	config.toolbar_composeMail =
	[{name: 'document', items: ['Preview' ]},
		{name: 'basicstyles', items : ['Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat']},
		{name: 'paragraph', items : ['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
		'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl']},
		{name: 'colors', items : ['TextColor','BGColor']},
		'/',
		{name: 'clipboard', items : ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo']},
		{name: 'editing', items : ['Find','Replace','-','SelectAll']},
		{name: 'styles', items : ['Format','Font','FontSize']},
		{name: 'insert', items : ['Table','HorizontalRule','Smiley','SpecialChar']},
	];
	
	config.height = 200;
	config.width = 680;
	
	config.resize_minWidth = 680;
	config.resize_minHeight = 200;
	
	config.resize_maxWidth = 680;
	config.resize_maxHeight = 200;
};
