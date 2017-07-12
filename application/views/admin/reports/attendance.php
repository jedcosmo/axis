<?php
/* 
 * @developer: j.dymosco
 * @date: 2017/02/08
 */
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
                <h3 class="box-title">Filter Attendance By</h3>
            </div>

              <div class="box-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>From</label>
                      <input type="text" value="<?php echo $start_date; ?>" class="form-control" name="start_date" id="start_date" autocomplete="off" />
                    </div>
                    <div class="col-md-6">
                      <label>To</label>
                      <input type="text" value="<?php echo $end_date; ?>" class="form-control" name="end_date" id="end_date" autocomplete="off" />
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                            <label>Number of Times Attended</label>
                            <select name="number_of_times" class="form-control">
                                <option value="0" <?php echo ((0 == $number_of_times) ? 'selected=""' : ''); ?>> -- 1 Or More -- </option>
                                <option value="no-attendance" <?php echo (('no-attendance' == $number_of_times) ? 'selected=""' : ''); ?>> -- Zero Attendance -- </option>                                
                                <?php $ctr = range(1,10); ?>
                                <?php foreach($ctr as $c){ ?>
                                     <option <?php echo (($c == $number_of_times) ? 'selected=""' : ''); ?> value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                <?php } ?>
                            </select> 
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
                    <th>Client</th>
                    <th>Attendance Count</th>
                    <th>Added By</th>
                    <th>Dates Attended</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($results){ ?>
                        <?php foreach($results as $result){ ?>
                            <tr>
                                <td><?php echo $result->First_Name?> <?php echo $result->Last_Name?></td>
                                <td><?php echo ($result->count_attended == NULL || $result->count_attended <= 0) ? '0' : $result->count_attended; ?></td>
                                <td><?php echo $result->AddedBy; ?></td>
                                <td><?php echo $result->DatesAttended; ?></td>
                            </tr>
                        <?php } ?>
                  <?php } ?>
                </tbody>
              </table>

            </div>
            
            <div class="box-footer text-right">
              <?php
                    $export_href = '';
                    if(count($results) > 0){
                        $export_href = 'href="/admin/reports/attendance_export/'.$start_date.'/'.$end_date.'/'.$number_of_times.'"';
                    }
              ?>
              <a <?php echo $export_href; ?> class="btn btn-flat btn-info">Export</a>
            </div>

          </div>
        </div>

      </div>
      <?php echo form_close(); ?>
        
    </section>
</div>
