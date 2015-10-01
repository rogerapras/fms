<style>
    table th{ text-align: center; }
</style>
<h2>CREATE INVOICING</h2>
<div id="spy8" class="panel">
    <div class="panel-body pn">
        <table class="table table-hover table-condensed table-striped table-responsive table-bordered">

                <tr class="dark">
                    <th>#</th>
                    <th>Company ID</th>
                    <th>Company Name</th>
                    <th>No Of Transactions</th>
                    <th>Create Invoicing</th>
                </tr>

                <? 
                    $cnt=1; 
                    for($i=0;$i<count($row_invoicing);$i++){ 
                ?>
                <tr <?=$danger;?>>
                    <td><?=$cnt;?></td>
                    <td><?=$row_invoicing[$i]['companyID'];?></td>
                    <td><?=$row_invoicing[$i]['companyName'];?></td>
                    <td align="center"><?=$row_invoicing[$i]['noOfTransactions'];?></td>
                    <td align="center">
                    <a href="invoicing_add.php?id=<?=$row_invoicing[$i]['companyID'];?>">
                        PROCEED <span class="fa fa-plus"></span>
                    </a></td>
                </tr>
                <? $cnt++; } ?>

        </table>
    </div>
</div>