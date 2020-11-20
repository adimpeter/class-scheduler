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

    $('.delete-schedule').on('click', function(e){
        e.preventDefault();
        var deleteForm = '.' + $(this).parent().attr('class');
        $('#formAction #deleteForm').val(deleteForm);
    });
    $('.delete-hall').on('click', function(e){
        e.preventDefault();
        var deleteForm = '.' + $(this).parent().attr('class');
        $('#formAction #deleteForm').val(deleteForm);
    });
    $('.delete-course').on('click', function(e){
        e.preventDefault();
        var deleteForm = '.' + $(this).parent().attr('class');
        $('#formAction #deleteForm').val(deleteForm);
    });
    $('.delete-lecturer').on('click', function(e){
        e.preventDefault();
        var deleteForm = '.' + $(this).parent().attr('class');
        $('#formAction #deleteForm').val(deleteForm);
    });

    $('#confirmAction').on('click', function(e){
        var deleteForm = $(this).siblings('#deleteForm').val();
        $(deleteForm).submit();
    });

    $('.add-schedule').on('click', function(e){
        e.preventDefault();

        var courseID        = $('#scheduleForm #courseid').val();
        var hallID          = $('#scheduleForm #hallid').val();
        var lecturerID      = $('#scheduleForm #lecturerid').val();
        var selectedDate    = $('#scheduleForm #date').val();

        var notifyDisplay   = $('#notify');
        var scheduleForm    = $('#scheduleForm');



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
                var errMsg = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    This Schedule already exists.

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`;

                if(result == 'true'){
                    notifyDisplay.html(errMsg);
                }else{
                    scheduleForm.submit();
                }
            },
            error: function(result){
                alert('An Error Occured.')
                console.log(result.responseText);
            }
    });
    })

    function deleteProperty(property){
        ('.delete-' + property).on('click', function(e){
            e.preventDefault();
            var deleteForm = '.' + $(this).parent().attr('class');
            $('#formAction #deleteForm').val(deleteForm);
        });
    }
});