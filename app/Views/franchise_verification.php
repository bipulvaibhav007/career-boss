<style>
    .franchise-section{
        /* padding-top: 50px; */
        width: 100%;
        min-height: 500px;
        /* color: white; */
        /* background-color: DodgerBlue; */
        /* text-align: center; */
    }
</style>
<div class="franchise-section">
    <div class="banner-stripe">
        <h2 class="text-center">Franchise Verification</h2>
    </div>
    <div class="container">
        <form class="w-50 mx-auto" action="<?=current_url();?>" method="get">
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="s" id="s" value="<?=(isset($_GET['s']))?$_GET['s']:''?>" placeholder="Center Name/ Center Code" required>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?=base_url('/franchise-verification')?>" class="btn btn-warning">Reset</a>
                </div>
            </div>
        </form>
        <?php if(isset($_GET['s'])){ ?>
        <div class="my-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 mx-2">Franchise Verification</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-borderless mb-0">
                        
                        <tbody>
                            <?php if(!empty($franchise)){ ?>
                            <tr>
                                <th width="200px" scope="row">Center Name</th>
                                <td><?=$franchise->center_name?></td>
                            </tr>
                            <tr>
                                <th width="200px" scope="row">Center Address</th>
                                <td><?=$franchise->center_address?></td>
                            </tr>
                            <tr>
                                <th width="200px" scope="row">Center Code</th>
                                <td ><?=$franchise->member_code?></td>
                            </tr>
                            <tr>
                                <th width="200px" scope="row">Owner Name</th>
                                <td ><?=$franchise->m_full_name?></td>
                            </tr>
                            <tr>
                                <th width="200px" scope="row">Phone No</th>
                                <td ><?=$franchise->phone?></td>
                            </tr>
                            <?php }else{
                                echo '<tr><td class="text-danger text-center">No data available</td></tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>