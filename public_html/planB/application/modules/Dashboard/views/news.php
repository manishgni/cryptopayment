<?php include_once 'header.php'; ?>
<style>
 section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
</style>
<div class="main-content">
  <div class="page-content">
<div class="container-fluid">
    <section class="content-header">
        <spna style="">News Section </spna> / All News
    </section>
    <div class="card">
        <div class="card-body">
            <div id="rootwizard" class="wizard wizard-full-width">
                <div class="wizard-content tab-content">
                    <div class="tab-pane active show" id="tabFundRequestForm">
                        <div class="row">
                            <?php foreach($news as $key => $n):?>
                            <div class="col-md-6">
                                <span><?php echo $n['title'];?></span>
                                <p><?php echo $n['news'];?></p>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include_once 'footer.php'; ?>
