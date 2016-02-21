/**
 * Created by TimerRiver Design Inc. on 12/02/16.
 */
jQuery(document).ready(function($){

    $('#fisa-event-datefrom').datetimepicker({
        step:1,
        minDate: new Date(),
        onClose: function(selectedDate){
            $('#fisa-event-dateto').datetimepicker({
                minDate: selectedDate
            });
        }
    });

    $('#fisa-event-dateto').datetimepicker({
        step: 1,
        minDate: $('#fisa-event-datefrom').val(),
        onClose: function(selectedDate){
            $('#fisa-event-datefrom').datetimepicker({maxDateTime: selectedDate});
        }
    });

    $('.ca_date').datetimepicker({
        step:1
    });

    $('.btn-date-icon').on('click',function(){
        $('.ca_date').datetimepicker('show');
    });
    
     $('#datetimepicker1').datetimepicker();
});