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
    //$id = $_SESSION['id'];
    $id = $_SESSION['id'];
    if (isset($_POST["advice"]))
    {
        $advice = trim($_POST['advice']);
        //get_advice
        date_default_timezone_set('Etc/GMT-8');
        $adate = date('Y-m-d',time());
        //get_date
        $selectbrwid ='select fbid
                       from Advice
                       order by fbid desc limit 1';
        $result = mysql_query($selectbrwid,$mysql); 
        $info = mysql_fetch_array($result);
        $fbid = $info['fbid']+1;
        //get_fbid;
        $selectSQL ='select username 
	                from User 
	                where userid="' . $id . '";';
        $result = mysql_query($selectSQL,$mysql); 
        if($result==false)  echo "<script type='text/javascript'> alert('查询失败！'); </script>";
        $info = mysql_fetch_array($result);
        $name = $info['username'];
                 
                 
        $insertq ='insert into Advice(fbid,userid,username,content,date)
	               values("'.$fbid.'","'.$id.'","'.$name.'","'.$advice.'","'.$adate.'");';
	    //echo $insertq;
	    $result = mysql_query($insertq,$mysql); 
	    if($result==false)  echo "<script type='text/javascript'> alert('查询失败！2'); </script>";
	    else echo "<script type='text/javascript'> alert('提交成功'); </script>";
    }
?>


<script type="text/javascript">
function check(form)
	{
		//var u_id = parseInt(form.username.value); 
		if(form.advice.value == "")
		{
			alert("意见不能为空！"); 
			form.advice.focus(); return false;
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
            <li>意见反馈</a></li>
        </ol>
    </div>
    <div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">意见反馈</h3>
            </div>
            <div class="panel-body" >
                <div class="col-sm-8 col-sm-offset-2">
                    <br/>
                    <h3 style="text-align: center"><b>意见反馈</b></h3>
                    <li>如果你在使用本网站的过程中遇到困难，或者对我们的网站建设有宝贵意见，希望您给我们留言，谢谢。</li>
                    <br/>
                    <form class="form-horizontal" id="form1" name="form1" method="post" action="<?php echo $formAction; ?>">
                    <textarea class="form-control" rows="6" name="advice"></textarea>
                    <br/>
                    <button type="submit" class="btn btn-default" onclick="return check(form1)">提交</button>
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
