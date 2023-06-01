<?php 


  // connect the database connection
  require_once("./database/dbase.php");


  // get the current user's udesi
  $uid = $_SESSION["uid"];
  $user = $conn->query("select * from user where uid='$uid'")->fetch();


  // get the pages that current logged user have access 
  $pages = [];

  $routes = $conn->query("select * from route")->fetchAll();

  foreach($routes as $route)
  {
    $desiArray = explode(",", $route["accessDesi"]); // 1,2,3,4 -> [1, 2, 3, 4]
    if (in_array($user["udesi"], $desiArray)) 
    {
      $pages[] = $route; 
    }
  }


?>


<aside class="main-sidebar sidebar-dark-primary elevation-4">
      
        <a  class="brand-link">
          <img src="./static/dist/img/avatar5.webp" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><?php echo $user["uname"]; ?></span>
        </a>

        
        <div class="sidebar">
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <?php foreach($pages as $page) : ?>
                    <li class="nav-item">
                      <a href="<?php echo $page['pgfile']; ?>" class="nav-link">
                      <i class="nav-icon <?php echo $page['pgicon']; ?>"></i>
                      <p><?php echo $page["pghead"]; ?></p>
                      </a>
                    </li>
                  <?php endforeach; ?>
                <!--
                <li class="nav-item">
                    <a href="received2.php" class="nav-link">
                    <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                    <p>Received Items</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="issued.php" class="nav-link">
                    <i class="nav-icon fas fa-long-arrow-alt-left"></i>
                    <p>issued Items</p>
                    </a>
                </li>
                
              
                <li class="nav-item">
                    <a href="reorderitem.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reorder Items</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="supplier.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Suppliers</p>
                    </a>
                </li>
                   
                <li class="nav-item">
                    <a href="users.php" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="order_item.php" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Order Item</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>profile</p>
                    
                    </a>
                </li> 
                  -->
            </ul>
          </nav>
          
        </div>
      </aside>