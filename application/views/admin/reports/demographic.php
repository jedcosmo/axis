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
                <h3 class="box-title">Filter By Demographic Feature</h3>
            </div>

              <div class="box-body">

                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label for="">Medicare Eligibility</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="medicare_eligibility" value="1" <?php echo $this->input->post('medicare_eligibility') == '1' ? 'checked="checked"':'' ?> />
                            Yes
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="medicare_eligibility" value="0" <?php echo $this->input->post('medicare_eligibility') == '0' ? 'checked="checked"':'' ?> />
                            No
                          </label>
                        </div>
                    </div> 
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label for="">Medicaid Eligibility</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="medicaid_eligibility" value="1" <?php echo $this->input->post('medicaid_eligibility') == '1' ? 'checked="checked"':'' ?> />
                            Yes
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="medicaid_eligibility" value="0" <?php echo $this->input->post('medicaid_eligibility') == '0' ? 'checked="checked"':'' ?> />
                            No
                          </label>
                        </div>
                    </div> 
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label for="">Community Status</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="community_status" value="live-in-community" <?php echo $this->input->post('community_status') == 'live-in-community' ? 'checked="checked"':'' ?> />
                            Live in community 
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="community_status" value="transitional-housing" <?php echo $this->input->post('community_status') == 'transitional-housing' ? 'checked="checked"':'' ?> />
                            Transitional Housing 
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="community_status" value="nursing-home" <?php echo $this->input->post('community_status') == 'nursing-home' ? 'checked="checked"':'' ?> />
                            Nursing Home
                          </label>
                        </div>
                    </div> 
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label for="">Marital Status</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="marital_status" value="married" <?php echo $this->input->post('marital_status') == 'married' ? 'checked="checked"':'' ?> />
                            Married
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="marital_status" value="not-married" <?php echo $this->input->post('marital_status') == 'not-married' ? 'checked="checked"':'' ?> />
                            Not Married
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="marital_status" value="divorced" <?php echo $this->input->post('marital_status') == 'divorced' ? 'checked="checked"':'' ?> />
                            Divorced
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="marital_status" value="separated" <?php echo $this->input->post('marital_status') == 'separated' ? 'checked="checked"':'' ?> />
                            Separated
                          </label>
                        </div>
                    </div> 
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label for="">Highest Completed Education</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="highest_completed_education" value="high-school" <?php echo $this->input->post('highest_completed_education') == 'high-school' ? 'checked="checked"':'' ?> />
                            High School 
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="highest_completed_education" value="some-college" <?php echo $this->input->post('highest_completed_education') == 'some-college' ? 'checked="checked"':'' ?> />
                            Some College 
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="highest_completed_education" value="college" <?php echo $this->input->post('highest_completed_education') == 'college' ? 'checked="checked"':'' ?> />
                            College 
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="highest_completed_education" value="graduated" <?php echo $this->input->post('highest_completed_education') == 'graduated' ? 'checked="checked"':'' ?> />
                            Graduated 
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="highest_completed_education" value="phd" <?php echo $this->input->post('highest_completed_education') == 'phd' ? 'checked="checked"':'' ?> />
                            PhD
                          </label>
                        </div>
                    </div> 
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label for="">Current Employment Status</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="employment_status" value="1" <?php echo $this->input->post('employment_status') == '1' ? 'checked="checked"':'' ?> />
                            Employed
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="employment_status" value="0" <?php echo $this->input->post('employment_status') == '0' ? 'checked="checked"':'' ?> />
                            Unemployed
                          </label>
                        </div>
                    </div> 
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label for="">Type of Income</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="type_of_income" value="ssi" <?php echo $this->input->post('type_of_income') == 'ssi' ? 'checked="checked"':'' ?> />
                            SSS
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="type_of_income" value="ssdi" <?php echo $this->input->post('type_of_income') == 'ssdi' ? 'checked="checked"':'' ?> />
                            SSDI
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="type_of_income" value="other" <?php echo $this->input->post('type_of_income') == 'other' ? 'checked="checked"':'' ?> />
                            Other
                          </label>
                        </div>
                    </div> 
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label for="">Internet Access</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="internet_access" value="1" <?php echo $this->input->post('internet_access') == '1' ? 'checked="checked"':'' ?> />
                            Yes
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="internet_access" value="0" <?php echo $this->input->post('internet_access') == '0' ? 'checked="checked"':'' ?> />
                            No
                          </label>
                        </div>
                    </div> 
                  </div>

                </div>  

              </div>

              <div class="box-footer with-border text-right">
                <input type="hidden" name="demographic" value="1">
                <button name="submit" value="filter" type="submit" id="btn-submit" class="btn btn-flat btn-success">Submit</button>
                <a href="<?php echo current_url(); ?>" class="btn btn-flat btn-warning" />Reset</a>
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
              <button name="submit" value="export" type="submit" id="btn-submit" class="btn btn-flat btn-info">Export</button>
            </div>
            
          </div>
        </div>

      </div>
      <?php echo form_close(); ?>


    </section>

</div>
