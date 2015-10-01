<? 
    require_once("inc/global.php"); 
    require_once(MODEL_PATH . SESSION_MODEL);
    require_once(MODEL_PATH . USERMENU_MODEL);
    require_once(MODEL_PATH . INVOICING_MODEL);
    require_once(CONTROLLER_PATH . INVOICING_CONTROLLER);
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

                        <? require_once(VIEW_PATH . V_INVOICINGADD); ?>

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
    <script type="text/javascript">
        function retTotalAmount(){
            var chk = document.getElementsByName('chkworefno[]');
            var len = chk.length;
            var total = 0;
            
            for(i=0;i<len;i++){
                if(chk[i].checked){
                    var val = chk[i].value;
                    var str = val.split("|");
                    total = parseFloat(total) + parseFloat(str[1]);
                    alert('val: ' . val + ' :: str: ' + str + ' :: total: ' + total);
                }
            }

            $("#txtTotal").val(total.toFixed(2));
        }
        function getChange(val){
            var total = $("#txtTotal").val();

            var change = 0;
            change = parseFloat(val) - parseFloat(total);

            $("#txtchange").val(change.toFixed(2));
        }
        function SelectAll(chkval){
            var chk = document.getElementsByName('chkworefno[]');
            // var chk = $("#chkworefno[]");
            var len = chk.length;
            var total = 0;
            
            if(chkval.checked){
                document.getElementById('chkAll').value = 1;
                // $("#chkAll").val("1");
                for(i=0;i<len;i++){
                    chk[i].checked = true;
                    var val = chk[i].value;
                    var str = val.split("|");
                    total = parseFloat(total) + parseFloat(str[1]);
                }
            }else{
                document.getElementById('chkAll').value = 0;
                // $("#chkAll").val("0");
                for(i=0;i<len;i++){
                    chk[i].checked = false;
                    total = 0;
                }
            }
            // document.getElementById("txtTotal").value = formatNumber(total);
            $("#txtTotal").val(total.toFixed(2));
        }
    </script>
</body>
</html>
