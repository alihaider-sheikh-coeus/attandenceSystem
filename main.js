

$(document).ready(function () {
    // var my_var = <?php echo json_encode($my_var); ?>;
    var timeInField = document.getElementById("TimeInField");
    var timeOutField = document.getElementById("TimeOutField");
    var hours;
   $(document).on("click", "#TimeIn", function () {

        let today = new Date();
    if(timeInField.value )
       {
           alert("you already have mark your attendance!");
       }
    else
    {

        timeInField.value = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        hours = today.getHours()
    }

    });
    $(document).on("click", "#TimeOut", function () {

        var today = new Date();
        if (timeInField.value == "") {
            alert("u have not entre the time in field")
        }else if(timeOutField.value)
        {
            alert("you already have mark your attendance!");
        }
        else {
            timeOutField.value = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            // hour = today.getHours();
        }
    });
    $(document).on("click", "#time_submit", function () {

        // var searchVal = $("#search_field").val();
        if (timeInField.value == "" && timeOutField.value == "") {
            alert("log your time please");
        }

        else {
            $.ajax({
                url: "attendance.php",
                type: "POST",
                cache: false,
                data: {timeInField: timeInField.value, timeOutField: timeOutField.value, hour: hours},
                success: function (dataResult) {
                   alert(dataResult);
                }
            });

        }
    });

});

$(document).on("click", "#hide", function() {
    document.getElementById('myModal').style.display='none';
});
$(document).on("click", "#edit", function() {
    $('#myModal').show();
    let id =$(this).parent().parent().find('.id').text()
    let Email_id = $(this).parent().parent().find('.Email_id').text();
    let name = $(this).parent().parent().find('.name').text();
    let designation = $(this).parent().parent().find('.designation').text();
    let salary = $(this).parent().parent().find('.salary').text();
    let boss = $(this).parent().parent().find('.boss').text();
    let image = $(this).parent().parent().find(".profile_image").map(function (){
        return this.src;
    }).get();
    $(".modal_id").val(id);
    $(".modal_email").val(Email_id);
    $( ".modal_name" ).val(name);
    $( ".modal_boss" ).val(boss);
    $( ".modal_salary" ).val(salary);
    $( ".modal_designation" ).val(designation);
    $(".modal_img").attr('src',image);
});

$(document).on("click", "#delete", function () {
    var result = confirm("Want to delete?");
    if (result) {
        var del_id = $(this).parent().parent().find('.id').text();
        var image = $(this).parent().parent().find('.profile_image').attr('src').split('/');
        var $ele = $(this).parent().parent();
        console.log(del_id,image[1]);
        $.ajax({
        url: "delete.php",
        type: "POST",
        cache: false,
        data: { del_id :del_id,image:image[1]},
        success: function(dataResult){
            console.log(dataResult);
            $ele.fadeOut().remove();
        }
        });
    }


});
$(document).on("click", "#getReport", function() {
    console.log("in get report");
    if($('#bdaymonth').val()=="")
    {
        alert("select the month");
    }
    else
    {
        var date = new Date($('#bdaymonth').val());
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        let starting_date =[year, month, day].join('-');
        let ending_date = [year,month,day+28].join('-');

        $.ajax({
            url: "report.php",
            type: "POST",
            cache: false,
            data: { starting_date : starting_date,ending_date: ending_date},
            success: function(dataResult){
              $('.report').html(dataResult);

            }
        });
    }
});


