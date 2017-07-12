<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Read Mail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="<?php echo base_url().'admin/contact' ?>"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right"><?php echo $count; ?></span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Mail</h3>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>From: <?php echo $contact->first_name; ?> <?php echo $contact->last_name; ?></h3>
                <h5>
                  Email: <?php echo $contact->email; ?>
                  <br/><br/>
                  Phone: <?php echo $contact->phone; ?>
                  <br/><br/>
                  Reason for contact: <?php echo $contact->reason; ?>
                  <span class="mailbox-read-time pull-right"><?php echo date('F j, Y H:i', strtotime($contact->date)); ?></span>
                </h5>
              </div>

              <div class="mailbox-read-message">
                <?php echo nl2br($contact->message); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>