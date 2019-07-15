   
    <script src="{!! asset('assets/plugins/jquery/jquery.min.js') !!}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{!! asset('assets/plugins/bootstrap/js/popper.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/bootstrap/js/bootstrap.min.js') !!}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{!! asset('assets/js/jquery.slimscroll.js') !!}"></script>
    <!--Wave Effects -->
    <script src="{!! asset('assets/js/waves.js') !!}"></script>
    <!--Menu sidebar -->
    <script src="{!! asset('assets/js/sidebarmenu.js') !!}"></script>
    <!--stickey kit -->
    <script src="{!! asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>
    <!--Custom JavaScript -->
    <script src="{!! asset('assets/js/custom.min.js') !!}"></script>

      <!-- chartist chart -->
      <script src="{!! asset('assets/plugins/chartist-js/dist/chartist.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/echarts/echarts-all.js') !!}"></script>
    <!-- Vector map JavaScript -->
    <script src="{!! asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') !!}"></script>
    <!-- Calendar JavaScript -->
    <script src="{!! asset('assets/plugins/moment/moment.js') !!}"></script>
    <script src="{!! asset('assets/plugins/calendar/dist/fullcalendar.min.js') !!}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> -->
    <script src="{!! asset('assets/plugins/calendar/dist/locale-all.js') !!}"></script>
    <script src="{!! asset('assets/plugins/calendar/jquery-ui.min.js') !!}"></script>
    
    <!-- <script src="{!! asset('assets/plugins/calendar/dist/cal-init.js') !!}"></script> -->
    
      <script src="{!! asset('assets/plugins/bootstrap-table/dist/bootstrap-table.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/bootstrap-table/dist/bootstrap-table.ints.js') !!}"></script>
   
  
  
    
    
   
    <!-- sparkline chart -->
    <script src="{!! asset('assets/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>
   
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{!! asset('assets/plugins/styleswitcher/jQuery.style.switcher.js') !!}"></script>
    <script src="{!! asset('assets/plugins/moment/moment.js') !!}"></script>
    <script src="{!! asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') !!}"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="{!! asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js') !!}"></script>
    
    <!-- Color Picker Plugin JavaScript -->
    <script src="{!! asset('assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js') !!}"></script>
    <script src="{!! asset('assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js') !!}"></script>
    <script src="{!! asset('assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') !!}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{!! asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{!! asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') !!}"></script>
     <!-- Date range Plugin JavaScript -->
    <script src="{!! asset('assets/plugins/icheck/icheck.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/icheck/icheck.init.js') !!}"></script>
    <script>
    // MAterial Date picker    
    $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
         $('#timepicker').bootstrapMaterialDatePicker({ format : 'HH:mm', time: true, date: false });
    $('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
   
        $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        minuteStep: 30,
        donetext: 'Done'
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
       
        
    });
   
  
    
   
   
   
    </script>




  

     <script src="{!! asset('assets/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
     
     
     <script type="text/javascript">
        pdfMake.fonts = {
        THSarabun: {
            normal: 'THSarabun.ttf',
            bold: 'THSarabun-Bold.ttf',
            italics: 'THSarabun-Italic.ttf',
            bolditalics: 'THSarabun-BoldItalic.ttf'
        }
    }
    </script>
    <!-- start - This is for export functionality only -->
   
     <script src="{!! asset('assets/plugins/footable/js/footable.all.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript') !!}"></script>

    <!--FooTable init-->
    <script src="{!! asset('assets/js/footable-init.js') !!}"></script>
    <script src="{!! asset('assets/plugins/sweetalert/sweetalert.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/sweetalert/jquery.sweet-alert.custom.js') !!}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"></script>
  
    <script type="text/javascript" src="{!!URL::asset('js/pdfmake.min.js')!!}"></script>
     <script type="text/javascript" src="{!!URL::asset('js/vfs_fonts.js')!!}"></script>
    <!-- <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    
   
   
    @yield('script')

   