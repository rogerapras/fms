<? 
    require_once("inc/global.php"); 
    require_once(MODEL_PATH . SESSION_MODEL);
    require_once(MODEL_PATH . USERMENU_MODEL);
    require_once(MODEL_PATH . OPENREMINDERS_MODEL);
    require_once(MODEL_PATH . CONTROLNO_MODEL);
    require_once(MODEL_PATH . WORKORDER_MODEL);
    require_once(CONTROLLER_PATH . WORKORDER_CONTROLLER);
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>FMS - Fleet Management System</title>
    <meta name="keywords" content="Fleet Management System" />
    <meta name="description" content="FMS - Fleet Management System">
    <meta name="author" content="FMS">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <? require_once(INCLUDE_PATH . "_font.php"); ?>
    <? require_once(INCLUDE_PATH . "_theme_css.php"); ?>
    <? require_once(INCLUDE_PATH . "_adminform_css.php"); ?>
    <? require_once(INCLUDE_PATH . "_favicon.php"); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <html dir="ltr" lang="en-US" class="no-js ie8">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>

<body class="admin-elements-page" data-spy="scroll" data-target="#nav-spy" data-offset="300">

    <? require_once(INCLUDE_PATH . "_theme.php"); ?>

    <!-- Start: Main -->
    <div id="main">

        <? require_once(INCLUDE_PATH . "_header.php"); ?>

        <? require_once(INCLUDE_PATH . "_sidebar.php"); ?>

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

            <? //require_once(INCLUDE_PATH . "_topbarDropdown.php"); ?>

            <? //require_once(INCLUDE_PATH . "_topbar.php"); ?>

            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- begin: .tray-center -->
                <div class="tray tray-center ph30 va-t posr animated-delay animated-long" data-animate='["800","fadeIn"]'>
                    <div class="mw1100 center-block">

                        <? require_once(VIEW_PATH . V_WORKORDERADD); ?>

                    </div>
                </div>
                <!-- end: .tray-center -->

            </section>
            <!-- End: Content -->

        </section>

        <? require_once(INCLUDE_PATH . "_sidebarRight.php"); ?>

    </div>
    <!-- End: Main -->
    
    <? require_once(INCLUDE_PATH . "_pageScript.php");?>
    <script type="text/javascript" src="assets/admin-tools/admin-forms/js/jquery.validate.min.js"></script>
    <!-- FileUpload JS -->
    <script type="text/javascript" src="assets/js/jquery.price_format.2.0.js"></script>
    <script type="text/javascript" src="assets/js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="assets/js/getData.js"></script>
    <script type="text/javascript">
        function onClickParts(){
            // $("#txtPartsQty").focus();
        }

        function getAssignee(val){
            var strURL = 'divWOgetAssignee.php?id=' + val;
            this.getData(strURL,'#assignee');
        }

        function removeParts(id){
            var arrParts = $("#txtPartsArray").val();
            var lbr = 0;
            var misc = 0;
            var disc = 0;

            // LABOR
            if($("#txtLabor").val() != ""){
                lbr = $("#txtLabor").val();
            }

            // MISCELLANEOUS
            if($("#txtMiscellaneous").val() != ""){
                misc = $("#txtMiscellaneous").val();
            }

            // DISCOUNT
            if($("#txtDiscount").val() != ""){
                disc = $("#txtDiscount").val();
            }

            var strURL = 'divWORemoveParts.php?id=' + id
                        + '&lbr=' + lbr
                        + '&misc=' + misc
                        + '&disc=' + disc
                        + '&arrParts=' + arrParts;
            this.getData(strURL,'#divCost');
        }
        function addNewParts(){
            var arrParts = $("#txtPartsArray").val();
            var id = $("#txtNewParts").val();
            var qty = 1;
            var lbr = 0;
            var misc = 0;
            var disc = 0;

            if($("#txtNewParts").val() == ""){
                alert('Please select parts to add!');
                return false;
            }

            // QUANTITY
            if($("#txtPartsQty").val() != ""){
                qty = $("#txtPartsQty").val();
            }

            // LABOR
            if($("#txtLabor").val() != ""){
                lbr = $("#txtLabor").val();
            }

            // MISCELLANEOUS
            if($("#txtMiscellaneous").val() != ""){
                misc = $("#txtMiscellaneous").val();
            }

            // DISCOUNT
            if($("#txtDiscount").val() != ""){
                disc = $("#txtDiscount").val();
            }

            var strURL = 'divWONewParts.php?id=' + id
                        + '&qty=' + qty
                        + '&lbr=' + lbr
                        + '&misc=' + misc
                        + '&disc=' + disc
                        + '&arrParts=' + arrParts;

            // SET QTY FIELD TO NULL
            $("#txtPartsQty").val("");
            
            this.getData(strURL,'#divCost');
        }
        
        function getTotalCost(){
            var labor = $('#txtLabor').val().replace(/,/g, '');
            var misc = $('#txtMiscellaneous').val().replace(/,/g, '');
            var parts = $('#txtParts').val().replace(/,/g, '');
            var disc = $('#txtDiscount').val().replace(/,/g, '');

            if(labor == ""){
                labor = 0;
            }

            if(misc == ""){
                misc = 0;
            }

            if(parts == ""){
                parts = 0;
            }

            if(disc == ""){
                disc = 0;
            }

            var subtotal = (parseFloat(labor) + parseFloat(misc) + parseFloat(parts)) - parseFloat(disc);
            var tax = parseFloat(subtotal * .12);

            if(isNaN(tax) == true){
                tax = 0;
            }

            $('#txtTax').val(tax.toFixed(2));
            $('#txtSubTotal').val(subtotal.toFixed(2));

            var totalcost = parseFloat(subtotal) + parseFloat(tax);

            // document.getElementById('txtTotalCost').value = totalcost.toFixed(2);
            $('#txtTotalCost').val(totalcost.toFixed(2));
        }

        jQuery(document).ready(function() {
            // Init Boostrap Multiselect
            $('#txtServiceType').multiselect();
            $('#txtEquipment').multiselect();
            $('#txtIsWarranty').multiselect();
            $('#txtIsBackJob').multiselect();
            $('#txtNewParts').multiselect();

            // NUMBERS w/ DECIMAL AND COMMA
            $('#txtLabor,#txtMiscellaneous,#txtParts,#txtDiscount,#txtTax,#txtTotalCost,#txtSubTotal').priceFormat({
                clearPrefix: true,
                prefix: '',
                centsSeparator: '.',
                thousandsSeparator: ',',
                centsLimit: 2
            });

            // NUMBERS ONLY w/o DECIMAL
            $('#txtMeter').priceFormat({
                clearPrefix: true,
                prefix: '',
                centsSeparator: '',
                thousandsSeparator: '',
                centsLimit: 0
            });

            $("#txtStartDate").datepicker({
                dateFormat: 'yy-mm-dd'
            });

            $( "#workorder-form" ).validate({
                errorClass: "state-error",
                validClass: "state-success",
                errorElement: "em",

                rules: {
                    txtServiceType: {
                            required: true
                    },
                    txtEquipment: {
                            required: true
                    },
                    txtAssignee: {
                            required: true
                    },
                    txtMeter: {
                            required: true,
                            min: 1
                    },
                    txtStartDate: {
                            required: true
                    },
                    txtRemarks: {
                            required: true
                    }
                },

                messages:{
                    txtServiceType: {
                            required: 'Please select Service Type!'
                    },
                    txtEquipment: {
                            required: 'Please select Equipment!'
                    },
                    txtAssignee: {
                            required: 'Please select Assignee!'
                    },
                    txtMeter: {
                            required: 'Please enter Meter!',
                            min: 'Meter cannot be zero(0) of value!'
                    },
                    txtStartDate: {
                            required: 'Please select Start Date!'
                    },
                    txtRemarks: {
                            required: 'Please enter Justification!'
                    }
                }
            });
        });
    </script>
    <div id="preloader" style="display: none;">Please wait...........
        <div><img src="imgs/loader.gif" id="preloader_image" ></div>
    </div>
</body>
</html>
