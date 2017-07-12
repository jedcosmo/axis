<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i>
            Users
            <small>View</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Users</li>
            <li class="active">View</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                 <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo anchor('admin/users/create', '<i class="fa fa-plus"></i> '. lang('users_create_user'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                    </div>
                    <div class="box-body">
                        <table id="table-axis" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo lang('users_firstname');?></th>
                                    <th><?php echo lang('users_lastname');?></th>
                                    <th><?php echo lang('users_email');?></th>
                                    <th><?php echo lang('users_groups');?></th>
                                    <th><?php echo lang('users_status');?></th>
                                    <th><?php echo lang('users_action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user):?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td>
                                    <?php foreach ($user->groups as $group):?>
                                        
                                        <?php //echo anchor('admin/groups/edit/'.$group->id, '<span class="label" style="background:'.$group->bgcolor.';">'.ucfirst(htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')).'</span>'); ?>
                                        <span class="label" style="background:<?php echo $group->bgcolor; ?>"><?php echo ucfirst(htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?></span>

                                    <?php endforeach?>
                                    </td>
                                    <td><?php echo ($user->active) ? anchor('admin/users/deactivate/'.$user->id, '<span class="label label-success">'.lang('users_active').'</span>') : anchor('admin/users/activate/'. $user->id, '<span class="label label-default">'.lang('users_inactive').'</span>'); ?></td>
                                    <td class="axis-actions">
                                        <?php echo anchor('admin/users/edit/'.$user->id, '<span class="label label-success"><i title="Edit" class="fa fa-edit"></i> '. lang('actions_edit') .'</span>'); ?>                                        
                                        <?php //echo anchor('admin/users/profile/'.$user->id, '<span class="label label-success"><i title="View" class="fa fa-eye"></i> '. lang('actions_see') .'</span>'); ?>
                                        <?php echo anchor('admin/users/delete/'.$user->id, '<span class="label label-danger"><i title="Delete" class="fa fa-times-circle"></i> Delete</span>'); ?>
                                    </td>                            
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
             </div>
        </div>
    </section>
</div>
