<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
      <?php include('reports_blocks.php'); ?>
        
      <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-filter_reports')); ?>
      <div class="row">

        <div class="col-xs-3"> 

          <div class="box box-primary">    
            <div class="box-header with-border">
                <h3 class="box-title">Filter By Client</h3>
            </div>

              <div class="box-body">

                <div class="form-group">
                  <label>Client Name</label>
                  <select class="form-control" id="client_filter" name="client_id">
                    <option value="0">-- All --</option>
                    <?php foreach($clients as $c): ?>
                      <option  <?php echo $this->input->post('client_id') == $c->ID ? 'selected="selected"':'' ?> value="<?php echo $c->ID; ?>"><?php echo $c->first_name; ?> <?php echo $c->last_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

              </div>

              <div class="box-footer with-border text-right">
                <button name="submit" value="filter" type="submit" id="btn-submit" class="btn btn-flat btn-success join_form_btn">Submit</button>
              </div>

          </div>

        </div>

        <div class="col-xs-9"> 
          <div class="box box-success">    
            <div class="box-header with-border">
                <h3 class="box-title">Results</h3>
            </div>

            <div class="box-body">
              
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Client</th>
                    <th>Activities</th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo $tr; ?>
                </tbody>
              </table>

            </div>
            
            <div class="box-footer text-right">
              <button name="submit" value="export" type="submit" id="btn-submit" class="btn btn-info btn-flat join_form_btn">Export</button>
            </div>
            
          </div>
        </div>

      </div>
      <?php echo form_close(); ?>


    </section>

</div>
