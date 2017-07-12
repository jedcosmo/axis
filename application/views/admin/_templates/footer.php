<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b><?php echo lang('footer_version'); ?></b> 1.0
                </div>
                <strong><?php echo lang('footer_copyright'); ?> &copy; <?php echo date('Y'); ?> AXIS</strong> <?php echo lang('footer_all_rights_reserved'); ?>.
            </footer>
        </div>
        
        <?php if($this->router->class != 'attendance'){ ?>
            <div class="modal fade bs-remove-modal-sm" role="dialog" id="remove-img-modal">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Remove</h4>
                    </div>
                    <div class="modal-body">
                      <p>Remove set featured image?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                      <button type="button" class="btn btn-primary" id="preview-edit-remove-btn-img">Yes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>
        
        <?php if($this->router->class == 'attendance'){ ?>
            <div class="modal fade bs-remove-modal-sm remove-attendance-modal" role="dialog" id="remove-attendance-modal">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Delete Attendance?</h4>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure on deleting this attendance record? Confirming deletion of attendance record will have no option to revert it back.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel Deletion</button>
                      <button type="button" class="btn btn-primary" id="remove-attendance-btn-modal">Yes, delete it.</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>

        <div id="loader" style="text-align:center; position:fixed; top:0; left:0; height:100%; width:100%; background:rgba(0, 0, 0, 0.5); z-index:9999; display:none;">
            <img src="<?php echo base_url()?>assets/img/loading.gif" alt="loading" style="position:absolute; margin:auto; top: 0; left: 0; bottom: 0; right: 0; width:100px; " />
        </div>

        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/slimscroll/slimscroll.min.js'); ?>"></script>
        <?php if ($mobile == TRUE): ?>
        <script src="<?php echo base_url($plugins_dir . '/fastclick/fastclick.min.js'); ?>"></script>
        <?php endif; ?>
        <?php if ($admin_prefs['transition_page'] == TRUE): ?>
        <script src="<?php echo base_url($plugins_dir . '/animsition/animsition.min.js'); ?>"></script>
        <?php endif; ?>
        <?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <script src="<?php echo base_url($plugins_dir . '/pwstrength/pwstrength.min.js'); ?>"></script>
        <?php endif; ?>
        <?php if ($this->router->fetch_class() == 'groups' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <script src="<?php echo base_url($plugins_dir . '/tinycolor/tinycolor.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.js'); ?>"></script>
        <?php endif; ?> 
        <script src="<?php echo base_url($frameworks_dir . '/adminlte/js/adminlte.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/domprojects/js/dp.min.js'); ?>"></script>
        
        <!-- DataTables -->
        <script src="<?php echo base_url($plugins_dir . '/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/datatables/dataTables.bootstrap.min.js'); ?>"></script>
        
        <!--<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>-->
        <script src="<?php echo base_url($plugins_dir . '/ckeditor/ckeditor.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/ckeditor/plugins/imageuploader/plugin.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>

        <!-- jQuery ui -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <!-- bootstrap datepicker -->
        <script src="<?php echo base_url($plugins_dir . '/datepicker/bootstrap-datepicker.js'); ?>"></script>  

        <!-- bootstrap timpicker -->
        <script src="<?php echo base_url($plugins_dir . '/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
        
        <script src="<?php echo base_url($plugins_dir . '/jquery-uploader/plupload.full.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/typehead/bootstrap-typeahead.min.js'); ?>"></script>
                 
        <script type="text/javascript">
            var plugins_dir = '<?php echo base_url($plugins_dir . '/jquery-uploader'); ?>';
            var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <script src="<?php echo base_url($plugins_dir . '/axis/axis.admin.common.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/axis/axis.uploader.jquery.js'); ?>"></script>
        
        <?php if( in_array($this->router->class, array('clients', 'activities')) ){ ?>
                <?php if($this->router->class == 'clients'){
                        $range_data_key = 5;
                      }else if($this->router->class == 'activities'){
                        $range_data_key = 0;
                      } 
                ?>        
                <script>
                    var table_axis_class = '<?php echo $this->router->class; ?>';
                    var range_data_key = <?php echo $range_data_key; ?>;
                </script>
            
            <script src="<?php echo base_url($plugins_dir . '/datatables_daterange/range_dates.js'); ?>"></script>
        <?php } ?>
    </body>
</html>