<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?php if ($admin_prefs['user_panel'] == TRUE): ?>
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('menu_online'); ?></a>
            </div>
        </div>

        <?php endif; ?>
        <?php /*if ($admin_prefs['sidebar_form'] == TRUE): ?>
        <!-- Search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <?php endif;*/ ?>
        <!-- Sidebar menu -->
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo site_url('/'); ?>">
                    <i class="fa fa-home text-primary"></i> <span><?php echo lang('menu_access_website'); ?></span>
                </a>
            </li>

            <li class="<?=active_link_controller('dashboard')?>">
                <a href="<?php echo site_url('admin/dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span><?php echo lang('menu_dashboard'); ?></span>
                </a>
            </li>
            
            <?php if( $user_role == 'admin' || in_array('has_clients_menu', $user_role_rights) ): ?>
            <li class="<?=active_link_controller('clients')?>">
                <a href="<?php echo site_url('admin/clients'); ?>">
                    <i class="fa fa-pencil-square-o"></i> <span>Clients</span>
                </a>
            </li>
            <?php endif; ?>

            <li class="<?=active_link_controller('activities')?>">
                <a href="<?php echo site_url('admin/activities'); ?>">
                    <i class="fa fa-calendar-check-o"></i> <span>Daily Activities</span>
                </a>
            </li>

            <li class="<?=active_link_controller('contact')?>">
                <a href="<?php echo site_url('admin/contact'); ?>">
                    <i class="fa fa-tty"></i> <span>Contact Form</span>
                </a>
            </li>
             
            <?php if( $user_role == 'admin' || in_array('has_cms_menu', $user_role_rights) ): ?>
                <li class="header text-uppercase">CONTENT MANAGEMENT</li>
                <li class="<?=active_link_controller('general')?>">
                    <a href="<?php echo site_url('admin/general/update'); ?>">
                        <i class="fa fa-gears"></i> <span>General</span>
                    </a>
                </li>
                <li class="<?=active_link_controller('pages')?>">
                    <a href="<?php echo site_url('admin/pages'); ?>">
                        <i class="fa fa-files-o"></i> <span>Pages</span>
                    </a>
                </li>
                <li class="<?=active_link_controller('blog')?>">
                    <a href="<?php echo site_url('admin/blog'); ?>">
                        <i class="fa fa-newspaper-o"></i> <span>Blog</span>
                    </a>
                </li>
                <li class="<?=active_link_controller('events')?>">
                    <a href="<?php echo site_url('admin/events'); ?>">
                        <i class="fa fa-calendar"></i> <span>Events</span>
                    </a>
                </li>
                <li class="<?=active_link_controller('stories')?>">
                    <a href="<?php echo site_url('admin/stories'); ?>">
                        <i class="fa fa-quote-left"></i> <span>Stories</span>
                    </a>
                </li>
                <li class="<?=active_link_controller('programs')?>">
                    <a href="<?php echo site_url('admin/programs'); ?>">
                        <i class="fa fa-archive"></i> <span>Programs</span>
                    </a>
                </li>
                <li class="<?=active_link_controller('team')?>">
                    <a href="<?php echo site_url('admin/team'); ?>">
                        <i class="fa fa-users"></i> <span>Team</span>
                    </a>
                </li>
                <li class="<?=active_link_controller('products')?>">
                    <a href="<?php echo site_url('admin/products'); ?>">
                        <i class="fa fa-cubes"></i> <span>Products</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if( $user_role == 'admin' || in_array('has_administration', $user_role_rights) ): ?>
            <li class="header text-uppercase"><?php echo lang('menu_administration'); ?></li>
            <li class="<?=active_link_controller('users')?>">
                <a href="<?php echo site_url('admin/users'); ?>">
                    <i class="fa fa-user"></i> <span><?php echo lang('menu_users'); ?></span>
                </a>
            </li>                                
            <?php endif; ?>
            
            <?php if( $user_role == 'admin' || in_array('has_reports_menu', $user_role_rights) ): ?>
                <li class="header text-uppercase">REPORTS</li>
                <li class="<?=active_link_controller('reports')?>">
                    <a href="<?php echo site_url('admin/reports'); ?>">
                        <i class="fa fa-book"></i> <span>Reports</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </section>
</aside>
