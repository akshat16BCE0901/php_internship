<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <!--left-fixed -navigation-->
  <aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="index.php"><span class="fa fa-area-chart"></span>MAWAI<span class="dashboard_text">Admin Dashboard</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="treeview">
                <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
              </li>
                <?php

                  $query = "select A.user_id,B.user,B.menu,C.id,C.name,C.href,C.parentmenuid,C.cdate from login2 as A left join adminmenus as B on A.id = B.user inner join menulist as C on B.menu = C.id where user_id='".$_SESSION['user']."' and parentmenuid IS NULL";
                  $result = mysqli_query($conn,$query);
                  if($result)
                  {
                    while ($row = mysqli_fetch_array($result)) 
                    {
                      echo "<li>
                          <a";

                          if(strlen($row[5])>6)
                          {
                            echo " class= 'masteranchor disanchor' ";
                          }
                          else
                          {
                            echo " class='dropdown-toggle' data-toggle='dropdown' ";
                          }

                           echo " style='cursor:pointer;' hef='".$row[5]."'>
                          <i class='fa fa-pie-chart'></i>
                          <span>".$row[4]."</span>"; 
                          $now = time();
                          $your_date = strtotime($row[7]);
                          $datediff = $now - $your_date;

                          if((round($datediff / (60 * 60 * 24))-1)<7)
                          {
                            echo "
                          <span class='label label-primary pull-right'>new</span>
                          ";
                          }
                          echo "</a>";
                          $query2 = "select A.user_id,B.user,B.menu,C.id,C.name,C.href,C.parentmenuid,C.cdate from login2 as A left join adminmenus as B on A.id = B.user inner join menulist as C on B.menu = C.id where user_id='".$_SESSION['user']."' and parentmenuid= ".$row[2];
                          $rr = mysqli_query($conn,$query2);
                          if($rr)
                          {
                            if(mysqli_num_rows($rr))
                            {
                                echo "<ul class='dropdown-menu'>";
                                while($row2 = mysqli_fetch_array($rr))
                                {
                                  echo "
                                          <li><a style='cursor:pointer;' class='disanchor' hef='".$row2[5]."'><i class='fa fa-angle-right'></i>".$row2[4]."</a></li>
                                        ";
                                }
                                echo "</ul>";
                                }
                            
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
  <script type="text/javascript">
    $(document).ready(function()
    {
      $(".disanchor").click(function()
      {
        var link  = $(this).attr("hef");
        
          $.ajax({

            type : 'POST',
            url : link,
            data : {



            },
            success : function(data)
            {
              $(".page-wrapper").html("Hurray");
            }

          });
      });
      $(".masteranchor").click(function()
      {
        var link  = $(this).attr("hef");
        
          $.ajax({

            type : 'POST',
            url : link,
            data : {



            },
            success : function(data)
            {
              $(".page-wrapper").html("Hurray");
            }

          });
      });
    });
  </script>