
<!-- jQuery 3 -->
<script src="../../dist/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- sortable -->
<script src="../../dist/js/jquery-sortable.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/maphilight/1.4.0/jquery.maphilight.min.js"></script>
<script type="text/javascript" src="../../dist/js/imageMapResizer.min.js"></script>
<!-- dataTables -->
<script src="../../dist/js/jquery.dataTables.js"></script>
<script src="../../dist/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../dist/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="../../dist/js/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../../dist/js/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="../../dist/js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="../../dist/js/pages/dashboard2.js"></script-->
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- select2 -->
<script src="../../dist/js/select2.full.min.js"></script>
<!-- easy-autocomplete -->
<script src="../../dist/js/jquery.easy-autocomplete.min.js"></script>
<!-- smoke -->
<script src="../../dist/js/smoke.js"></script>
<!-- owl -->
<script src="../../dist/js/owl.carousel.js"></script>
<!-- ckeditor -->
<script src="../../ckeditor/ckeditor.js"></script>


<!-- datepicker -->
<script src="../../dist/js/bootstrap-datepicker.js"></script>
<script src="../../dist/js/bootstrap-datepicker-thai.js"></script>
<script src="../../dist/js/locales/bootstrap-datepicker.th.js"></script>

<!-- datetimepicker -->
<script src="../../dist/js/moment.min.js"></script>
<script src="../../dist/js/daterangepicker.js"></script>
<script src="../../dist/js/nl.js"></script>
<script src='../../dist/js/bootstrap-datetimepicker.min.js'></script>


<!-- mainFunc -->
<script src="../../dist/js/mainFunc.js"></script>


<script type="text/javascript">

function logout(){
  // alert(1);
  $.smkConfirm({
    text:'Are You Sure Log out?',
    accept:'Yes',
    cancel:'No'
  },function(res){
    // Code here
    if (res) {
     window.location='../../pages/login/';
    }
  });
}
</script>
