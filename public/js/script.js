$(document).ready(function(){
    $('#menu').on('click', '.menu-item', function(e){
        // e.preventDefault();
        var dropdown = $(this).find('.dropdown');

        if(dropdown.height() > 0){
            dropdown.css({
                'height': '0px'
            });
        }else{
            dropdown.css({
                'height': 'auto'
            });
        }
    });

    $('.add-schedule').on('click', function(e){
        e.preventDefault();

        var courseID        = $('#scheduleForm #courseid').val();
        var hallID          = $('#scheduleForm #hallid').val();
        var lecturerID      = $('#scheduleForm #lecturerid').val();
        var selectedDate    = $('#scheduleForm #date').val();



        $.ajaxSetup({
            headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
       $.ajax({
            url: "/schedule/check",
            method: 'post',
            data: {
                course_id : courseID,
                hall_id : hallID,
                lecturer_id : lecturerID,
                date : selectedDate,
            },

            success: function(result){
                console.log(result);
                console.log(result.responseText);
                console.log({courseID, lecturerID, hallID, selectedDate});
            },
            error: function(result){
                alert('An Error Occured.')
                console.log(result.responseText);
            }
    });
    })
});