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
	   $selectSQL ='select upassword
	                from User 
	                where userid="' . $id . '";';
       $result = mysql_query($selectSQL,$mysql); 
       if($result==false)  echo "<script type='text/javascript'> alert('查询失败1！'); </script>";
       $info = mysql_fetch_array($result);	
       $opw = $info['upassword'];
       //echo "<script type='text/javascript'> alert($opw); </script>"; 
	   if ($opw != $pw) echo "<script type='text/javascript'> alert('原密码错误！'); </script>";
	   else{
	         $selectSQL ='update User
	                      set upassword = "' . $npw . '" 
	                      where userid = "' . $id . '";';
	         $result = mysql_query($selectSQL,$mysql); 
	         if($result==false)  echo "<script type='text/javascript'> alert('更新密码失败！'); </script>";
	         else echo"<script type='text/javascript'> alert('更新密码成功！'); </script>";  
	       }
	 }
?>



<?php
   $id = $_SESSION['id'];
   $selectSQL ='select username,upassword,umail,type,dept,brwnum 
	            from User 
	            where userid="' . $id . '";';
   $result = mysql_query($selectSQL,$mysql); 
   if($result==false)  echo "<script type='text/javascript'> alert('查询失败！'); </script>";
   else {
            $info = mysql_fetch_array($result);	
            $email = $info['umail'];
            $opw = $info['upassword'];
            $dept = $info['dept'];
            $name = $info['username'];
            $type = $info['type'];
            $num = $info['brwnum'];
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
                <a class="navbar-brand" href="uindex.php">首页</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li ><a href="ubrw.php">预约<span class="sr-only">(current)</span></a></li>
                        <li><a href="rank.php">榜单</a></li>
                        <li><a href="usearch.php">搜索</a></li>
                        <li><a href="advice.php">意见反馈</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="uprofile.php">个人信息</a></li>
                            <li><a href="urecord.php"> 在借书籍</a></li>
                            <li><a href="record.php">借阅记录 </a></li>
                            <li class="divider"></li>
                            <li><a href="ulogout.php">退出</a></li>
                        </ul>
                    </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div>
        <ol class="breadcrumb">
            <li><a href="uindex.php">主页</a></li>
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
                            <label for="inputid" class="col-sm-2 control-label">学号/工号</label>
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
                            <label for="inputchara" class="col-sm-2 control-label" >读者类别</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="inputchara"  value="<?php echo $type; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputdept" class="col-sm-2 control-label" >院系</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="inputdept" value="<?php echo $dept; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputbrwnum" class="col-sm-2 control-label" >已借阅数</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputbrwnum" value="<?php echo $num; ?>" disabled>
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
