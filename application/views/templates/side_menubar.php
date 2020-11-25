<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
   <?php ?>   
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="nav navbar-nav" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if($user_permission): ?>
          <li class="dropdown" id="userMainNav">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-users"></i>
                <span>User Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="dropdown-menu" role="menu">
                
                <?php if(in_array('createUser', $user_permission) ||in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                <li id="manageUserSubNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-user"></i> Manage Users</a></li>
              <?php endif; ?>
                  <li class="divider"></li>
              <?php
               if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupSubMenu"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-users"></i> Manage Groups</a></li>
                <?php endif; ?>
                  <li class="divider"></li>
              <?php
                if(in_array('updateCompany', $user_permission)): ?>
                <li id="companyMainNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-info-circle"></i> <span>Company Info</span></a></li>
              <?php endif; ?>
                  <li class="divider"></li>
              <?php
               if(in_array('viewProfile', $user_permission)): ?>
                <li id="profileMainNav"><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-address-card-o"></i> <span>Profile</span></a></li>
              <?php endif; ?>
                  <li class="divider"></li>
              <?php
               if(in_array('updateSetting', $user_permission)): ?>
                <li id="settingMainNav"><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
              <?php endif; ?>
              </ul>
            </li>
  
          <li class="dropdown" id="reservationMainNav">
              <a href="#"class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-connectdevelop"></i>
                <span>Modules</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="dropdown-menu" role="menu">
              <?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
                  <li id="storesMainNav"><a href="<?php echo base_url('stores/') ?>"><i class="fa fa-home"></i> <span>Stores</span></a></li>
                <?php endif; ?>
                  <li class="divider"></li>
              <?php
                 if(in_array('createBanner', $user_permission) || in_array('updateBanner', $user_permission) || in_array('viewBanner', $user_permission) || in_array('deleteBanner', $user_permission)): ?>
                  <li id="bannersMainNav"><a href="<?php echo base_url('banner/') ?>"><i class="fa fa-image"></i> <span>Banners</span></a></li>
                <?php endif; ?>
                  <li class="divider"></li>
              <?php
                 if(in_array('createGallery', $user_permission) || in_array('updateGallery', $user_permission) || in_array('viewGallery', $user_permission) || in_array('deleteGallery', $user_permission)): ?>
                  <li id="bannersMainNav"><a href="<?php echo base_url('gallery/') ?>"><i class="fa fa-picture-o"></i> <span>Gallery</span></a></li>
                <?php endif; ?>
                  <li class="divider"></li>
              <?php
                 if(in_array('createChefs', $user_permission) || in_array('updateChefs', $user_permission) || in_array('viewChefs', $user_permission) || in_array('deleteChefs', $user_permission)): ?>
                  <li id="chefsMainNav"><a href="<?php echo base_url('chefs/') ?>"><i class="fa fa-user-circle"></i> <span>Chefs</span></a></li>
                <?php endif; ?>
                  <li class="divider"></li>
              <?php
             if(in_array('createBlogs', $user_permission) || in_array('updateBlogs', $user_permission) || in_array('viewBlogs', $user_permission) || in_array('deleteBlogs', $user_permission)): ?>
                  <li id="blogsMainNav"><a href="<?php echo base_url('blogs/') ?>"><i class="fa fa-rss-square"></i> <span>Blogs</span></a></li>
                <?php endif; ?>
                  <li class="divider"></li>
              <?php
                 if(in_array('createTable', $user_permission) || in_array('updateTable', $user_permission) || in_array('viewTable', $user_permission) || in_array('deleteTable', $user_permission)): ?>
          <li id="tablesMainNav"><a href="<?php echo base_url('tables/') ?>"><i class="fa fa-table"></i> <span>Tables</span></a></li>
        <?php endif; 
         ?>
              </ul>
            </li>
            <li class="dropdown" id="reservationMainNav">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-files-o"></i>
                <span>Product Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <?php
                if(in_array('createCategory', $user_permission)): ?>
                  <li id="createCategorySubMenu"><a href="<?php echo base_url('category/') ?>"><i class="fa fa-circle-o"></i>Category</a></li>
                <?php endif; ?>
                <li class="divider"></li>
                 <?php if(in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                <li id="manageCategorySubMenu"><a href="<?php echo base_url('category/sub_category') ?>"><i class="fa fa-circle-o"></i>Sub Category</a></li>
                <?php endif; ?>
                  <li class="divider"></li>
              <?php
             if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductSubMenu"><a href="<?php echo base_url('products') ?>"><i class="fa fa-circle-o"></i> Products</a></li>
                <?php endif; ?>
              </ul>
            </li>
            <li class="dropdown" id="reservationMainNav">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-files-o"></i>
                <span>Sales</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <?php if(in_array('createReservation', $user_permission) || in_array('updateReservation', $user_permission) || in_array('viewReservation', $user_permission) || in_array('deleteReservation', $user_permission)): ?>
              <li class="" id="reservationMainNav">
                <a href="<?php echo base_url('reservation') ?>">
                  <i class="fa fa-files-o"></i>
                  <span>Table Reservation</span>
                </a>
              </li>
              <?php endif; 
                  ?>
                  <li class="divider"></li>
              <?php
               if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrderSubMenu"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> Orders</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url('orders/online') ?>"><i class="fa fa-circle-o"></i> Online Orders</a></li>
                <?php endif; 
                ?>
                <li class="divider"></li>
            <?php
                 if(in_array('createTakeAwayOrder', $user_permission) || in_array('updateTakeAwayOrder', $user_permission) || in_array('viewTakeAwayOrder', $user_permission) || in_array('deleteTakeAwayOrder', $user_permission)): ?>
                <li id="manageTakeAwayOrderSubMenu"><a href="<?php echo base_url('TakeAwayOrders') ?>"><i class="fa fa-circle-o"></i> TakeAway Orders</a></li>
                <?php endif; ?>
            </ul>
            </li>
            
          <?php if(in_array('viewReport', $user_permission)): ?>
            <li class="dropdown" id="ReportMainNav">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-th-list"></i>
                <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="productReportSubMenu"><a href="<?php echo base_url('reports') ?>"><i class="fa fa-list-alt"></i> Product Wise</a></li>
                  <li class="divider"></li>
                  <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-list"></i> Total Store wise</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
        <?php endif; ?>
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>