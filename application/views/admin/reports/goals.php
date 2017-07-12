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
                <h3 class="box-title">Filter By Goals</h3>
            </div>

              <div class="box-body">

                <select name="goal" class="form-control">
                  <option <?php echo $this->input->post('goal') == 'weight_loss' ? 'selected="selected"':'' ?> value="weight_loss">Weight Loss</option>
                  <option <?php echo $this->input->post('goal') == 'increased_strength' ? 'selected="selected"':'' ?> value="increased_strength">Increased Strength</option>
                  <option <?php echo $this->input->post('goal') == 'increased_socialization' ? 'selected="selected"':'' ?> value="increased_socialization">Increased Socialization</option>
                  <option <?php echo $this->input->post('goal') == 'increased_aerobic' ? 'selected="selected"':'' ?> value="increased_aerobic">Increased Aerobic</option>
                  <option <?php echo $this->input->post('goal') == 'improve_transfer' ? 'selected="selected"':'' ?> value="improve_transfer">Improve Transfer</option>
                  <option <?php echo $this->input->post('goal') == 'increase_wheelchair_mobilization' ? 'selected="selected"':'' ?> value="increase_wheelchair_mobilization">Increase Wheelchair Mobilization</option>
                  <option <?php echo $this->input->post('goal') == 'reduce_hospitalization' ? 'selected="selected"':'' ?> value="reduce_hospitalization">Reduce Hospitalization</option>
                  <option <?php echo $this->input->post('goal') == 'pursue_education' ? 'selected="selected"':'' ?> value="pursue_education">Pursue Education</option>
                  <option <?php echo $this->input->post('goal') == 'pursue_vacation' ? 'selected="selected"':'' ?> value="pursue_vacation">Pursue Vocation</option>
                  <option <?php echo $this->input->post('goal') == 'increased_self_sufficiency' ? 'selected="selected"':'' ?> value="increased_self_sufficiency">Increased Self Sufficiency </option>
                  <option <?php echo $this->input->post('goal') == 'increased_self_advocacy' ? 'selected="selected"':'' ?> value="increased_self_advocacy">Increased Self-Advocacy </option>
                </select>

              </div>

              <div class="box-footer with-border text-right">
                <input type="hidden" name="goals" value="1">
                <button name="submit" value="filter" type="submit" id="btn-submit" class="btn btn-success">Submit</button>
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
                    <th>Goal</th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Phone</th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo $tr; ?>
                </tbody>
              </table>

            </div>
            
            <div class="box-footer text-right">
              <button name="submit" value="export" type="submit" id="btn-submit" class="btn btn-info">Export</button>
            </div>
            
          </div>
        </div>

      </div>
      <?php echo form_close(); ?>


    </section>

</div>
