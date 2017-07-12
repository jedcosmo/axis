<div class="content-wrapper">

    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i>
        Reports
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reports</li>
      </ol>
    </section>


    <section class="content">

      <div class="row">

        <div class="col-xs-4"> 

          <div class="box box-primary">    
            <div class="box-header with-border">
                <h3 class="box-title">Filter By Client</h3>
            </div>

            <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-filter_reports')); ?>
              <div class="box-body">

                <div class="form-group">
                  <label>Client</label>
                  <select class="form-control" id="client_filter">
                    <option value="">-- All --</option>
                    <?php foreach($clients as $c): ?>
                      <option value="<?php echo $c->ID; ?>"><?php echo $c->first_name; ?> <?php echo $c->last_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Demographic Feature</label>
                  <select class="form-control" id="demographic_filter">
                    <option value="">-- All --</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Goals</label>
                  <select class="form-control" id="goals_filter">
                    <option value="">-- All --</option>
                  </select>
                </div>

              </div>

              <div class="box-footer text-right">
                <button name="save" type="submit" id="btn-submit" class="btn btn-success">Save</button>
                <input type="reset" value="Reset" class="btn btn-warning" />
              </div>

          </div>

          <div class="box box-primary">    
            <div class="box-header with-border">
                <h3 class="box-title">Filter by Activity</h3>
            </div>

              <div class="box-body">

                <div class="form-group">
                  <label>Activity</label>
                  <select class="form-control" id="activity_filter">
                    <option value="">-- All --</option>
                    <?php foreach($activities as $a): ?>
                      <option value="<?php echo $a->ID; ?>"><?php echo $a->title; ?></option>
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
                      <?php echo form_input($from_date); ?>
                    </div>
                  </div>
                </div>

              </div>

              <div class="box-footer text-right">
                <button name="save" type="submit" id="btn-submit" class="btn btn-success">Save</button>
                <input type="reset" value="Reset" class="btn btn-warning" />
              </div>

            <?php echo form_close(); ?>

          </div>

        </div>

        <div class="col-xs-8"> 
          <div class="box box-success">    
            <div class="box-header with-border">
                <h3 class="box-title">Results</h3>
            </div>

            <div class="box-body">
              
              <table id="table-axis" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Client</th>
                    <th>Demographic Feature</th>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Goals</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
              </table>

            </div>

            <div class="box-footer text-right">
              <a href="javascript:void(0)" class="btn btn-info">Export</a>
            </div>

          </div>
        </div>

      </div>

    </section>

</div>