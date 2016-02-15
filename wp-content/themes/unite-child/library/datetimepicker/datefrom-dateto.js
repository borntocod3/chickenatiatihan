/**
 * Created by TimerRiver Design Inc. on 12/02/16.
 */
jQuery(document).ready(function($){

    $('#fisa-event-datefrom').datetimepicker({
        step:5,
        minDate: new Date(),
        onClose: function(selectedDate){
            $('#fisa-event-dateto').datetimepicker({
                minDate: selectedDate
            });
        }
    })

    $('#fisa-event-dateto').datetimepicker({
        step: 5,
        minDate: $('#fisa-event-datefrom').val(),
        onClose: function(selectedDate){
            $('#fisa-event-datefrom').datetimepicker({maxDateTime: selectedDate});
        }
    });
});