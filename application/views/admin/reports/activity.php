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
                <h3 class="box-title">Filter By Activity</h3>
            </div>

              <div class="box-body">

                <div class="form-group">
                  <label>Activity Name</label>
                  <select class="form-control" id="activity_filter" name="activity_id">
                    <option value="0">-- All --</option>
                    <?php foreach($activities as $a): ?>
                      <option  <?php echo $this->input->post('activity_id') == $a->ID ? 'selected="selected"':'' ?> value="<?php echo $a->ID; ?>"><?php echo $a->title; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>From</label>
                      <?php echo form_input($from_date); ?>
                    </div>
                    <div class="col-md-6">
                      <label>To</label>
                      <?php echo form_input($to_date); ?>
                    </div>
                  </div>
                </div>

              </div>

              <div class="box-footer with-border text-right">
                <button name="submit" value="filter" type="submit" id="btn-submit" class="btn btn-flat btn-success">Submit</button>
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
                    <th>Activity</th>
                    <th>Information</th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo $tr; ?>
                </tbody>
              </table>

            </div>
            
            <div class="box-footer text-right">
              <button name="submit" value="export" type="submit" id="btn-submit" class="btn btn-flat btn-info">Export</button>
            </div>

          </div>
        </div>

      </div>
      <?php echo form_close(); ?>


    </section>

</div>
