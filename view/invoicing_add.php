<style>
    table th{ text-align: center; }
</style>
<h2>CREATE INVOICING</h2>
<div id="spy8" class="panel">
    <div class="panel-body pn">
        <table class="table table-hover table-condensed table-striped table-responsive table-bordered">

            <tr class="dark">
                <th><input type="checkbox" name="chkAll" id="chkAll" checked onclick="SelectAll();"></th>
                <th>#</th>
                <th>WO Reference #</th>
                <th>WO Date</th>
                <th>Service Type</th>
                <th>Plate No</th>
                <th>Assignee</th>
                <th>Total Cost</th>
            </tr>

            <? 
                $cnt=1; 
                $total = 0;
                for($i=0;$i<count($row_invoicingdtl);$i++){ 
                    $total += $row_invoicingdtl[$i]['totalCost'];
            ?>
            <tr>
                <td align="center"><input type="checkbox" name="chkworefno[]" id="chkworefno[]" onclick="return retTotalAmount();" 
                    value="<?=$row_invoicingdtl['woReferenceNo'] .'|'. $row_invoicingdtl['totalCost'];?>" checked /></td>
                <td><?=$cnt;?></td>
                <td><?=$row_invoicingdtl[$i]['woReferenceNo'];?></td>
                <td align="center"><?=dateFormat($row_invoicingdtl[$i]['woTransactionDate'],"M d, Y");?></td>
                <td align="center"><?=$row_invoicingdtl[$i]['serviceType'];?></td>
                <td align="center"><?=$row_invoicingdtl[$i]['plateNo'];?></td>
                <td><?=$row_invoicingdtl[$i]['assignee'];?></td>
                <td align="right"><?=number_format($row_invoicingdtl[$i]['totalCost'],2);?></td>
            </tr>
            <? $cnt++; } ?>

        </table>
    </div>
</div>
<div id="spy8" class="panel">
    <div class="panel-body pn">
        <br />
        <div class="form-group text-right">
            <div class="col-lg-8">&nbsp;</div>
            <label class="col-lg-2">Total</label>
            <div class="col-lg-2">
                <input name="txtTotal" id="txtTotal" type="text" value="<?=number_format($total,2);?>" readonly class="form-control gui-input input-sm text-right" />
            </div>
        </div>
        <div class="form-group text-right">
            <div class="col-lg-8">&nbsp;</div>
            <label class="col-lg-2">Amount Received</label>
            <div class="col-lg-2">
                <input type="text" name="txtamountreceived" id="txtamountreceived" onKeyup="getChange(this.value);" class="form-control gui-input input-sm text-right" />
            </div>
        </div>
        <div class="form-group text-right">
            <div class="col-lg-8">&nbsp;</div>
            <label class="col-lg-2">Change</label>
            <div class="col-lg-2">
                <input type="text" name="txtchange" id="txtchange" readonly class="form-control gui-input input-sm text-right" />
            </div>
        </div><br />
        <div class="form-group text-right">
            <label class="col-sm-11">&nbsp;</label>
            <div class="col-xs-1">
                <button class="btn btn-sm btn-dark btn-block btn-gradient" type="submit"> SUBMIT </button>
            </div>
        </div>
    </div>
</div>