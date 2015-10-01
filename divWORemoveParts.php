<?
    $id = $_GET['id'];
    $lbr = $_GET['lbr'];
    $misc = $_GET['misc'];
    $disc = $_GET['disc'];
    $arrParts = $_GET['arrParts'];

    $newArrParts = null;

    $parts = explode("|",$arrParts);
    for($a=0;$a<count($parts);$a++){
        if(!empty($parts[$a]) || $parts[$a] != "" || $parts[$a] != null){
            $partsItem = explode("::",$parts[$a]);
            if($partsItem[0] != $id){
                $newArrParts .= $parts[$a];
                $newArrParts .= '|';
            }
        }
    }

    $newArrParts = rtrim($newArrParts,"|");
?>
<span id="divCost">
<div class="form-group">
    <table class="table table-hover table-condensed table-striped table-responsive table-bordered">
        <tr>
            <th>#</th>
            <th>Desc</th>
            <th>Price(Qty)</th>
            <th>Total</th>
            <th>Remove</th>
        </tr>
        <? 
            $cnt = 1; 
            $partsCost = 0;
            if(!empty($newArrParts) || $newArrParts != null || $newArrParts != ""){
                $parts = explode("|",$newArrParts);
                for($a=0;$a<count($parts);$a++){ 
                    $partsItem = explode("::",$parts[$a]);
                    $desc = $partsItem[2]; // description 
                    $priceQty = number_format($partsItem[3],2) . ' (' . $partsItem[4] . ')'; // price(qty)
                    $total = ($partsItem[3] * $partsItem[4]);
                    $partsCost += $total;
        ?>
        <tr>
            <td><?=$cnt;?></td>
            <td><?=$desc;?></td>
            <td align="right"><?=$priceQty;?></td>
            <td align="right"><?=number_format($total,2);?></td>
            <td align="center">
                <a href="#" onClick="removeParts('<?=$partsItem[0];?>');">
                    <span class="fa fa-trash"></span>
                </a>
            </td>
        </tr>
        <?
            $cnt++; }}

            $subTotal = ($lbr + $misc + $partsCost) - $disc;
            $tax = ($subTotal * .12);
            $totalCost = ($subTotal + $tax);
        ?>
    </table>
    <input type="hidden" name="txtPartsArray" id="txtPartsArray" value="<?=$newArrParts;?>" />
</div>
<div class="form-group">&nbsp;</div>
<div class="form-group">
    <label class="col-lg-3" for="txtLabor">Labor</label>
    <div class="col-lg-4">
        <input type="text" value="<?=number_format($lbr,2);?>" name="txtLabor" id="txtLabor" class="form-control gui-input input-sm" onBlur="getTotalCost();" placeholder="0.00" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3" for="txtMiscellaneous">Miscellaneous</label>
    <div class="col-lg-4">
        <input type="text" value="<?=number_format($misc,2);?>" name="txtMiscellaneous" id="txtMiscellaneous" class="form-control gui-input input-sm" onBlur="getTotalCost();" placeholder="0.00" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3" for="txtParts">Parts</label>
    <div class="col-lg-4">
        <input type="text" value="<?=number_format($partsCost,2);?>" name="txtParts" id="txtParts" readonly class="form-control gui-input input-sm" onBlur="getTotalCost();" placeholder="0.00" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3" for="txtDiscount">Discount</label>
    <div class="col-lg-4">
        <input type="text" value="<?=number_format($disc,2);?>" name="txtDiscount" id="txtDiscount" class="form-control gui-input input-sm" onBlur="getTotalCost();" placeholder="0.00" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3" for="txtSubTotal">Sub-Total</label>
    <div class="col-lg-4">
        <input type="text" value="<?=number_format($subTotal,2);?>" name="txtSubTotal" id="txtSubTotal" readonly class="form-control gui-input input-sm" placeholder="0.00" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3" for="txtTax">Tax</label>
    <div class="col-lg-4">
        <input type="text" value="<?=number_format($tax,2);?>" name="txtTax" id="txtTax" readonly class="form-control gui-input input-sm" placeholder="0.00" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3" for="txtTotalCost">Total</label>
    <div class="col-lg-4">
        <input type="text" value="<?=number_format($totalCost,2);?>" name="txtTotalCost" id="txtTotalCost" readonly class="form-control gui-input input-sm" placeholder="0.00" />
    </div>
</div>
</span>
<script type="text/javascript" src="assets/js/jquery.price_format.2.0.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        // NUMBERS w/ DECIMAL AND COMMA
        $('#txtLabor,#txtMiscellaneous,#txtParts,#txtDiscount,#txtTax,#txtTotalCost,#txtSubTotal').priceFormat({
            clearPrefix: true,
            prefix: '',
            centsSeparator: '.',
            thousandsSeparator: ',',
            centsLimit: 2
        });
    });
</script>