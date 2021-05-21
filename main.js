$(document).ready(function () {
    var timeInField = document.getElementById("TimeInField");
    var timeOutField = document.getElementById("TimeOutField");
    // var today = new Date();
    // var hour = today.getHours();
    $(document).on("click", "#TimeIn", function () {

        var today = new Date();
        timeInField.value = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        hours = today.getHours()

    });
    $(document).on("click", "#TimeOut", function () {

        var today = new Date();
        if (timeInField.value == "") {
            alert("u have not entre the time in field")
        } else {
            timeOutField.value = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            // hour = today.getHours();
        }
    });
    $(document).on("click", "#time_submit", function () {

        // var searchVal = $("#search_field").val();
        if (timeInField.value == "" && timeOutField.value == "") {
            alert("log your time please");
        } else {
            $.ajax({
                url: "attendance.php",
                type: "POST",
                cache: false,
                data: {timeInField: timeInField.value, timeOutField: timeOutField.value, hour: hours},
                success: function (dataResult) {
                    console.log(dataResult);
                }
            });

        }
    });

});

$(document).on("click", "#delete", function () {
    var result = confirm("Want to delete?");
    if (result) {
        var del_id = $(this).parent().parent().find('.Email_id').text();
        var image = $(this).parent().parent().find('.profile_image').attr('src').split('/');
        var $ele = $(this).parent().parent();
        console.log(del_id,image[1]);
        $.ajax({
        url: "delete.php",
        type: "POST",
        cache: false,
        data: { del_id :del_id,image:image[1]},
        success: function(dataResult){
            console.log(del_id);
            $ele.fadeOut().remove();
        }
        });
    }
});