<?php require_once('../dbconnect.php'); ?>
<?php require_once('../all.php'); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
	if(isset($_GET['del']))
	{
		$id = trim($_GET['del']);
		$query = 'Delete  
		          from Staff  
		          Where staffid="'. $id .'";';
		$result = mysql_query($query,$mysql);
		if($result)
		{
				echo "<script>
				      type='text/javascript'> alert('删除成功！'); 
				      location.href='aindex.php'; </script>";	
		}
		else
		{
				echo "<script type='text/javascript'> alert('删除失败！'); </script>";				
		} 
		//die();
    }
?>

<script type="text/javascript">
	
	
	function del(url)
	{
		if( confirm("确认删除工作人员?") )
		{
				//document.location.
				//alert(url);
				//window.open(url);			
				 window.location.href =url;	
				//window.open(url,'_self');
				//header('Location:url');
				//href="auser.php?type=delete&id='.userid.'";
		}		//else { alert("已取消！");}
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
                    <a class="navbar-brand" href="aindex.php">管理系统</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="asearchb.php">图书管理</a></li>
                        <li><a href="asearchu.php">读者管理</a></li>
                        <li><a href="asearchw.php">工作人员管理</a></li>
                        <li><a href="aadvice.php">读者来信</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="aprofile.php">更改密码</a></li>
                                <li><a href="../staff/sindex.php">工作系统</a></li>
                                <li class="divider"></li>
                                <li><a href="alogout.php">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div>
        <ol class="breadcrumb">
            <li><a href="aindex.php">管理系统</a></li>
            <li><a href="asearchw.php">工作人员管理</a></li>
            <li><a href="asearchs.php">查找工作人员</a></li>
            <li>搜索结果</a></li>
        </ol>
    </div>
    <div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">搜索结果</h3>
            </div>
            <div class="panel-body" >
                <!--<table class="table table-hover table-responsive">
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>操作</th>
                    </tr>
                 </table>-->
                <!--<nav>
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>-->

<?php
    //$formAction = $_SERVER['PHP_SELF'];
    $searchitem = trim($_POST['searchitem']);
	$searchword = trim($_POST['searchword']);	
    //echo "<script type='text/javascript'> alert('$searchword'); </script>";
    //echo "<script type='text/javascript'> alert('$searchitem'); </script>";
    if(isset($_POST['searchword']) || $_POST['searchword']!='')
    {
	    //$searchitem = trim($_POST['searchitem']);
		//$searchword = trim($_POST['searchword']);		
		$query = 'select *  
		          from Staff 
		          where '.$searchitem.' like "%'.$searchword.'%";';
		$result = mysql_query($query,$mysql);
		if ($result==false) echo "<script type='text/javascript'> alert('查询失败！'); </script>";
		else
		   {  
		      echo '<div class="panel-body">';
		      echo '<table class="table table-hover table-responsive">';
		      $item .= '<tr><th>#</th>';
			  $item .= '<th>工作人员ID</th>';
			  //$item .= '<td>'.$row['isbn'].'</td>'; 
			  $item .= '<th>工作人员姓名</th>';
			  $item .= '<th>工作邮箱</th>';
		      $item .= '<th>操作</td>';
			  $item .= '</tr>';
			  echo $item;
		      $tag=1;
		      //echo "<script type='text/javascript'> alert('！'); </script>";
		      while($row = mysql_fetch_array($result))
		      {
			     if ($row['staffid'] != '111') 
		        {
			        $item = '<tr><td>'.$tag.'</td>';
    			    $item .= '<td>'.$row['staffid'].'</td>';
    			    $item .= '<td>'.$row['staffname'].'</td>';	
    		        $item .= '<td>'.$row['smail'].'</td>';			 
    			    $item .= '<td><a class="btn btn-primary btn-xs" onclick=del("asearchsresult.php?del='.$row['staffid'].'"); return false; >删除工作人员</a></td>';
    			    $item .= '</tr>';
    				echo $item;
    				$tag=$tag+1;
    			}
              }
              echo '</table>';
              mysql_free_result($result);
           }
    }
?> 
 
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
