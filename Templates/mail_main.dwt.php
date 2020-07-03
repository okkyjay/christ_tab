<?php
@include('sess.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>ADComS&trade; ::: </title>
<!-- TemplateEndEditable -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="../css/bootstrap.css" rel="stylesheet">
<style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
  }
  .sidebar-nav {
    padding: 9px 0;
  }
</style>
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="../imgs/favicon.ico">
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <span class="brand">ADComS&trade;</span>
      <div class="nav-collapse">
      <!-- TemplateBeginEditable name="TopMenu" -->
        <ul class="nav">
          <li><a href="mail_home.php">Mail</a></li>
          <li><a href="address_book.php">Address Book</a></li>
          <li><a href="notepad.php">Note-Pad</a></li>
        </ul>
      <!-- TemplateEndEditable -->
      <!-- TemplateBeginEditable name="UserInfoSide" -->
      <p class="navbar-text pull-right"><a href="#"><span class="icon-white icon-user"></span>View Profile</a> | Logged in as <?php echo $_SESSION['uid']; ?> <a href="?option=logout">Signout</a></p>
      <!-- TemplateEndEditable --></div><!--/.nav-collapse -->
    </div>
  </div>
</div>

<div class="container span 10">
  <div class="row-fluid"><!-- TemplateBeginEditable name="SideMenu" -->
    <div class="span3">
      <div class="well sidebar-nav">
        <ul class="nav nav-list">
          <li class="nav-header">MENU</li>
          <li><a href="compose_msg.php"><span class="icon-pencil"></span>New Message</a></li>
          <li><a href="inbox_msg.php"><span class="icon-inbox"></span>Inbox</a></li>
          <li><a href="sent_msg.php"><span class="icon-forward"></span>Sent</a></li>
          <li><a href="draft_msg.php"><span class="icon-folder-close"></span>Draft</a></li>
          <li><a href="trash_msg.php"><span class="icon-trash"></span>Trash</a></li>
        </ul>
      </div>
      <!--/.well -->
    </div>
  <!-- TemplateEndEditable --><!--/span--><!-- TemplateBeginEditable name="PageBody" -->
  <div class="span9">
    <div class="row-fluid" style="height:400px">
      <!--/span-->
      <!--/span-->
      MsgList </div>
    <!--/row-->
  </div>
  <!-- TemplateEndEditable --><!--/span-->
  </div><!--/row-->

  <hr>

  <footer>
    <p>&copy; Adekunle Ajasin University, Akungba-Akoko, Ondo State 2012</p>
  </footer>

</div><!--/.fluid-container-->

<div class="modalMsg modal fade hide" id="">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 id="modHead" class="modHead">Modal header</h3>
    </div>
    <div class="modal-body"></div>
    <div class="modal-footer"><a href="#" class="btn btn-primary close" data-dismiss="modal">Close</a></div>
</div>

<script src="../js/jquery-1.7.1.min.js"></script>
<script src="../js/bootstrap-transition.js"></script>
<script src="../js/bootstrap-alert.js"></script>
<script src="../js/bootstrap-modal.js"></script>
<script src="../js/bootstrap-dropdown.js"></script>
<script src="../js/bootstrap-scrollspy.js"></script>
<script src="../js/bootstrap-tab.js"></script>
<script src="../js/bootstrap-tooltip.js"></script>
<script src="../js/bootstrap-popover.js"></script>
<script src="../js/bootstrap-button.js"></script>
<script src="../js/bootstrap-collapse.js"></script>
<script src="../js/bootstrap-carousel.js"></script>
<script src="../js/bootstrap-typeahead.js"></script>

<script src="../js/jquery.form.js" type="text/javascript"></script>
<script src="../js/jquery.metadata.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>

<!-- TemplateBeginEditable name="PageScripts" -->
<script type="text/javascript" language="javascript">
    jQuery(function() {
        var container = $('#err_cont');
        var v = jQuery("#appForm").validate({
            submitHandler: function(form) {
                $('#submit_btn').button('loading');
                jQuery(form).ajaxSubmit({
                    success: function (rm) {
                        var data = $.parseJSON(rm);
                        if (data.status != 'error')
                        {
                            if(data.status == 'validation')
                            {
                                $('.modHead').html('Data Validation Error!');
                                $('.modal-body').html(data.msg);
                                $('.modalMsg').modal('show');
                                $('#submit_btn').button('reset');
                            }
                            else
                            {
                                $('.modHead').html('Registration Success!');
                                $('.modal-body').html(data.msg);
                                $('.modalMsg').modal('show');
                                setTimeout(function(){
                                    $('.modalMsg').modal('hide');
                                    $('.modal-body').html('');
                                    document.location = '<?php echo $_SERVER['PHP_SELF'];?>';
                                },5000);
                                v.resetForm();
                                $('#submit_btn').button('reset');
                                $('input:text').val('');
                                $('textarea').val('');
                            }
                        }
                        else
                        {
                            $('.modHead').html('Data Submission Error!');
                            $('.modal-body').html(data.msg);
                            $('.modalMsg').modal('show');
                            $('#submit_btn').button('reset');
                        }
                        return false;
                    }
                });
            },
            errorContainer: container,
            errorLabelContainer: $("ul", container),
            wrapper: 'li'
        })
        
    $('#reset').click(function ()
        {
            $.ajax().abort();
            $('#submit_btn').button('reset');
        })
    })
</script>
<!-- TemplateEndEditable -->
</body>
</html>
