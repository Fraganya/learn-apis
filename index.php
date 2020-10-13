<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Samples</title>
</head>

<body>

    <form action="#" style="margin-bottom:20px;">
        <input type="text" id="fname" placeholder="Firstname">
        <input type="text" id="sname" placeholder="Surname">
        <input type="text" id="reg" placeholder="Reg #">
        <button onclick="save_student()" type="button">
            Save
        </button>
    </form>
    <div id="students-container">
    </div>

    <script src="./jquery-3.4.1.min.js"></script>
    <script>
     function save_student(){
            var data = {
                'fname':$("#fname").val(),
                'sname':$("#sname").val(),
                'reg':$("#reg").val()
            }

            var url = "http://localhost:8080/backend.php?intent=store";

            $.ajax({
                url:url,
                type:"POST",
                data:data,
                success:function(data,status){
                    load_data();
                    alert("Student successfully added");
                },
                error:function(error){
                    console.log(error);
                }
            });
        }


        function load_data() {
            var url = "http://localhost:8080/backend.php?intent=get";

            $.ajax({
                url: url,
                type: "GET",
                success: function(data, status) {
                    students = JSON.parse(data);
                    
                    $("#students-container").html("")
                    for (var student of students) {
                        var _html = "<div style='margin-bottom:10px;'>";
                        _html += "Firstname : " + student.first_name + "<br>";
                        _html += "Surname   : " + student.first_name + "<br>";
                        _html += "Reg : " + student.reg + "<br>";
                        _html += "</div><hr>";

                        $("#students-container").append(_html);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

    $(document).ready(function() {
        load_data();

    });
    </script>
</body>

</html>