<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/19/16
 * Time: 8:11 PM
 */
?>
<script src="<?php echo $assets ?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $assets ?>js/bootstrap.min.js"></script>
<script src="<?php echo $assets ?>js/chart.min.js"></script>
<script src="<?php echo $assets ?>js/chart-data.js"></script>
<script src="<?php echo $assets ?>js/easypiechart.js"></script>
<script src="<?php echo $assets ?>js/easypiechart-data.js"></script>
<script src="<?php echo $assets ?>js/bootstrap-datepicker.js"></script>
<script src="<?php echo $assets ?>js/bootstrap-table.js"></script>

<script>
    $('#calendar').datepicker({
    });

    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
</body>

</html>

