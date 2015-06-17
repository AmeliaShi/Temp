<?php require_once('../dbconnect.php'); ?>
<?php require_once('../all.php'); ?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Library</title>
    <link  href="../bootstrap.min.css" rel="stylesheet">
    <!--  <script src="jquery-1.8.0.min.js"></script>
      <script src="bootstrap.min.js"></script> -->
    <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<?php
	$formAction = $_SERVER['PHP_SELF'];
	$id = $_SESSION['id'];
	if ($_POST['opw']!="" && $_POST['npw2']!="")
	{
	   $pw = trim($_POST['opw']);
	   $npw = trim($_POST['npw2']);
	   $selectSQL ='select spassword
	                from Staff 
	                where staffid="' . $id . '";';
       $result = mysql_query($selectSQL,$mysql); 
       if($result==false)  echo "<script type='text/javascript'> alert('查询失败！'); </script>";
       $info = mysql_fetch_array($result);	
       $opw = $info['spassword'];
       //echo "<script type='text/javascript'> alert($opw); </script>"; 
	   if ($opw != $pw) echo "<script type='text/javascript'> alert('原密码错误！'); </script>";
	   else{
	         $selectSQL ='update Staff
	                      set spassword = "' . $npw . '" 
	                      where staffid = "' . $id . '";';
	         $result = mysql_query($selectSQL,$mysql); 
	         if($result==false)  echo "<script type='text/javascript'> alert('更新密码失败！'); </script>";
	         else echo"<script type='text/javascript'> alert('更新密码成功！'); </script>";  
	       }
	 }
?>



<?php
   $id = $_SESSION['id'];
   $selectSQL ='select staffname,smail,spassword 
	            from Staff 
	            where staffid="' . $id . '";';
   $result = mysql_query($selectSQL,$mysql); 
   if($result==false)  echo "<script type='text/javascript'> alert('查询失败！'); </script>";
   else {
            $info = mysql_fetch_array($result);	
            $email = $info['smail'];
            $opw = $info['spassword'];
            $name = $info['staffname'];
         }   
?>


<script type="text/javascript">
	function check(form)
	{			
		if(form.opw.value == "")
		    if(form.npw1.value != "" || form.npw2.value != "") 
		     {
			    alert("请输入密码！");
			    return false;
			  } else {
			            if (form.opw.value.length<6 || form.opw.value.length>16)
			            {
			                alert("密码长度应在6到16之间！");
			                form.opw.focus(); return false;
			            }
			         }
				
		if(form.npw1.value != "")
		{
		    if(form.npw1.value.length<6 || form.npw1.value.length>16)
		    { 
		      alert("密码长度应在6到16之间！");
			  form.npw1.focus(); return false;  
			}
			if(form.npw2.value == "") 
			{ 
			  alert("请确认密码！");
			  form.npw2.focus(); return false; 
			}
			if(form.npw1.value != form.npw2.value)
		    {
			alert("两次密码输入不一致！");
			return false;
		    }  
		}
		
		form.submit();
	}
	
</script>

<body>
<div class="container">
    <div >
        <div class="page-header">
          <img src="../head1.jpg">
        </div>
    </div>
    <div role="navigation">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="sindex.php">工作系统</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="sindex.php">借还</a></li>
                        <li><a href="ssearch.php">查询</a></li>
                        <li><a href="sadvice.php">读者来信</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Worker <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="sprofile.php">个人信息</a></li>
                                <li class="divider"></li>
                                <li><a href="wlogout.php">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div>
        <ol class="breadcrumb">
            <li><a href="sindex.php">主页</a></li>
            <li>个人信息</a></li>
        </ol>
    </div>
    <div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">个人信息</h3>
            </div>
            <div class="panel-body" >
                <div class="col-sm-8 col-sm-offset-2">
                    <form class="form-horizontal" name="form1" id="form1" method="POST" action="<?php echo $formAction; ?>">
                        <div class="form-group">
                            <label for="inputname" class="col-sm-2 control-label">姓名</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputname" value="<?php echo $name; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputid" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputid" value="<?php echo $id; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">E-mail</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail" value="<?php echo $email; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputoldPassword" class="col-sm-2 control-label">旧密码</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputoldPassword" placeholder="Old Password" name="opw">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputnewPassword" class="col-sm-2 control-label" value="">新密码</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputnewPassword" placeholder="New Password" name="npw1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputnewPassword0" class="col-sm-2 control-label" value="">确认密码</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputnewPassword0" placeholder="Confirm New Password" name="npw2">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" name="button" onclick="return check(form1)">更新</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
        <hr>
<footer>
<p style="text-align: center">&copy Design By: 13307130318 13307130501</p>
</footer>
</div>
</body>
</html>
