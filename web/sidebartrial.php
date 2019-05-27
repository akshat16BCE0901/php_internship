<?php
  session_start();
  require '../connect.php';

  $conn = mysqli_connect($servername,$username,$password,$database);
  if($conn)
  {
      echo " ";
  }
  else
  {
    echo "Error - ".mysqli_error($conn);
  }

?>


<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
	<aside class="sidebar-left" style="overflow-y: auto;">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="index.html"><span class="fa fa-area-chart"></span>MAWAI<span class="dashboard_text">Admin Dashboard</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
                <?php

                  $query = "select A.user_id,B.user,B.menu,C.id,C.name,C.href,C.parentmenuid from login2 as A left join adminmenus as B on A.id = B.user inner join menulist as C on B.menu = C.id where user_id='".$_SESSION['user']."'";
                  $result = mysqli_query($conn,$query);
                  if($result)
                  {
                    while ($row = mysqli_fetch_array($result)) 
                    {
                      echo "<li";  
                    if($row[6]>0)
                    {
                      echo "";
                    }
                    else{
                      echo " class='treeview'";
                    }
                      echo">
                          <a href='".$row[5]."'>
                          <i class='fa fa-pie-chart'></i>
                          <span>".$row[4]."</span>
                          <span class='label label-primary pull-right'>new</span>
                          </a>";
                          $query2 = "select A.user_id,B.user,B.menu,C.id,C.name,C.href,C.parentmenuid from login2 as A left join adminmenus as B on A.id = B.user inner join menulist as C on B.menu = C.id where user_id='".$_SESSION['user']."' and parentmenuid= ".$row[2];
                          $rr = mysqli_query($conn,$query2);
                          if($rr)
                          {
                            echo "<ul class='treeview-menu'>";
                            while($row2 = mysqli_fetch_array($rr))
                            {
                              echo "
                                      <li><a href='".$row2[5]."'><i class='fa fa-angle-right'></i>".$row2[4]."</a></li>
                                    ";
                            }
                            echo "</ul>";
                          }
                        echo "</li>";
                    }

                  }

              ?>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
  <div>
    
  </div>