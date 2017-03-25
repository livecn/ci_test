<?php $this->layout('layouts::admin/default') ?>

<br/><br/><br/><br/><br/><br/>
<!-- Main content -->
<section class="content">

    <div class="error-page">
        <h2 class="headline text-red">403</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! <?php echo $ci_object->lang->line('aauth_error_no_access'); ?>.</h3>

            <p>
                You may <a href="<?php echo base_url('admin'); ?>">return to dashboard</a> or try other.
            </p>

        </div>
    </div>
    <!-- /.error-page -->

</section>