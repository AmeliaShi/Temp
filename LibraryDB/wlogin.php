<?php require_once('../dbconnect.php'); ?>
<?php require_once('../all.php'); ?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>复旦大学图书馆</title>
    <link  href="../bootstrap.min.css" rel="stylesheet">
    <!--  <script src="jquery-1.8.0.min.js"></script>
      <script src="bootstrap.min.js"></script> -->
    <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<?php
	$formAction = $_SERVER['PHP_SELF'];
	if (isset($_POST["MyForm"]) && ($_POST["MyForm"] == "form1"))
	{
	   //echo "<script type='text/javascript'> alert('！'); </script>"; 
	   $id = trim($_POST['userid']);
	   $password = trim($_POST['password']);
	   //echo "<script type='text/javascript'> alert( $password ); </script>";
	   $selectSQL ='select staffid 
	                from Staff 
	                where staffid="' . $id . '";';
	   $result = mysql_query($selectSQL,$mysql); 
	   if($result==false)  echo "<script type='text/javascript'> alert('查询失败！'); </script>";
	   else {
	         $info=mysql_fetch_array($result);
	         if ($info!=false) {
	                            $selectSQL ='select spassword 
	                                         from Staff 
 								             where staffid="' . $id . '";'; 								 
	   							$result = mysql_query($selectSQL,$mysql); 
 								if ($result==false) echo "<script type='text/javascript'> alert('查询失败！'); </script>";
 								else {
 								      $info=mysql_fetch_array($result);
 								      if ($info['spassword'] != $password) echo "<script type='text/javascript'> alert('密码错误！'); </script>";
 								      else {
 								            $_SESSION['id'] = $id;
 								            //$_SESSION['logged'] = true;						            
 								            echo "<script>
				        	                      type='text/javascript'> alert('登录成功！'); </script>";  
				        	                if ($id == '111') echo "<script> location.href='adm/asearchb.php'; </script>";
				        	                else echo "<script> location.href='staff/sindex.php'; </script>";
 								            return;
 								           } 								            
 								     }
	                            } else echo "<script type='text/javascript'> alert('该工号未添加！'); </script>";
	       }
	 }
?>

<script type="text/javascript">
	function check(form)
	{
		var u_id = parseInt(form.userid.value); 
		if(form.userid.value == "")
		{
			alert("ID不能为空！"); 
			form.userid.focus(); return false;
		}
				
		if(form.password.value == "")
		{
			alert("密码不能为空！");
			form.password.focus(); return false;
		}
		
		if(form.password.value.length<6 || form.password.value.length>16)
		{
			alert("密码长度应在6到16之间！");
			form.password.focus(); return false;
		}
		
		form.submit();
	}
</script>

<body>
<div class="container" >
    <div>
        <div class="page-header">
          <img src="head1.jpg">
        </div>
    </div>
    <div>
        <ol class="breadcrumb">
            <li><a href="newindex.php">主页</a>/工作人员登录页</a></li>
        </ol>
    </div>

    <form class="form-horizontal " id="form1" name="form1" method="POST" action="<?php echo $formAction; ?>">
        <div class="form-group">
            <label for="inputid3" class="col-sm-2 control-label col-sm-offset-2">ID</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="inputid3" placeholder="id" name="userid">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label col-sm-offset-2">Password</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
            </div>
        </div>

        
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-1">
                <button type="submit" class="btn btn-default">Sign in</button>
            </div>
            <div class="form-group">
                <input type="hidden" id="MyForm" name="MyForm" value="form1" >
            </div>
        </div>
    </form>
    <hr>
<footer>
<p style="text-align: center">&copy Design By: 13307130318 13307130501</p>
</footer>
</div>
</body>
</html>
