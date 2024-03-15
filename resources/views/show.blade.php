<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Student List</h1>
    <span id="output"></span>
    <table id="studentTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
       $(document).ready(function() {
    // Function to fetch student data
    function fetchStudents() {
        $.ajax({
            url: "{{ route('students.index') }}",
            method: 'GET',
            success: function(response) {
                $('#studentTable tbody').empty();

                response.forEach(function(student) {
                    var row = '<tr>';
                    row += '<td>' + student.id + '</td>';
                    row += '<td>' + student.name + '</td>';
                    row += '<td>' + student.email + '</td>';
                    row += '<td><a href="/edit-student/' + student.id + '">Edit</a> | <a href="#" class="deleteData" data-id="' + student.id + '">Delete</a></td>';
                    row += '</tr>';
                    $('#studentTable tbody').append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch students:', error);
            }
        });
    }

    fetchStudents();

    // Delete student 
    $('#studentTable').on('click', '.deleteData', function() {
        var id = $(this).attr('data-id');
        var obj = $(this);
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "DELETE",
            url: "/delete-student/" + id,
            data: {
                _token: token
            },
            success: function(data) {
                $(obj).parent().parent().remove();
                $("#output").text(data.result);
            },
            error: function(xhr, status, error) {
                console.error('Failed to delete student:', error);
            }
        });
    });



});

    </script>
</body>
</html>
