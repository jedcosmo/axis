<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <?php echo $message;?>

      <?php echo form_open_multipart(current_url(), array('class' => '', 'id' => 'form-edit_user')); ?>
        <div class="row">
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Account Information</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group  ">
                      <label>First Name</label>
                      <?php echo form_input($first_name);?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group  ">
                      <label>Last Name</label>
                      <?php echo form_input($last_name);?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group  ">
                      <label for="">Email</label>
                      <?php echo form_input($email);?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group  ">
                      <label>Image</label>
                      <input type="file" value="" name="image" id="exampleInputFile">
                      <p class="help-block">Size: 2MB • Dimension: 300 x 300</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            
          <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Login Information</h3>
                </div>
                <div class="box-body">
                  <?php if ($this->ion_auth->is_admin()): ?>
                    <div class="form-group ">
                      <label>Account Type</label>
                      <select name="groups" class="form-control">
                        <option value="">-- Select One --</option>
                        <?php foreach ($groups as $group):?>
                            <?php
                                $gID     = $group['id'];
                                $selected = NULL;
                                $item    = NULL;

                                foreach($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                        $selected = ' selected="selected"';
                                        break;
                                    }
                                }
                            ?>
                            <option value="<?php echo $group['id'];?>" <?php echo $selected; ?>><?php echo ucfirst(htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8')); ?></option>                            
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <?php endif; ?>
                  <div class="form-group ">
                    <label>Password</label>
                    <?php echo form_input($password);?>
                    <div class="progress" style="margin:0">
                        <div class="pwstrength_viewport_progress"></div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label>Retype Password</label>
                    <?php echo form_input($password_confirm);?>
                  </div>
                </div>
              </div>
            </div>
        </div>      
        <!-- /.row -->
        <div class="box-footer">
            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>
            
            <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-success btn-flat', 'content' => lang('actions_submit'))); ?>
            <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
            <?php echo anchor('admin/users', lang('actions_cancel'), array('class' => 'btn btn-danger btn-flat')); ?>            
        </div>
      <?php echo form_close();?>
    </section>
    <!-- /.content -->
</div>
