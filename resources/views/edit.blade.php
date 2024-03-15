<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Student</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', ['id' => $student->id]) }}" method="POST" id="edit-form">

        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $student->name }}" placeholder="Enter Name" required>
        <br><br>
        <input type="email" name="email" value="{{ $student->email }}" placeholder="Enter Email" required>

        <br><br>
        <input type="submit" value="Update Student" id="btnUpdate">
    </form>
    <span id="output"></span>

    <script>
        $(document).ready(function(){
            var studentId = "{{ $student->id }}"; 

            // Fetch student data for editing
            $.ajax({
                type: "GET",
                url: "{{ route('students.edit', ['id' => $student->id]) }}",
                success: function(data) {
                    $("input[name='name']").val(data.name);
                    $("input[name='email']").val(data.email);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch student data:', error);
                }
            });

            // Handle form submission for update
            $("#edit-form").submit(function(event){
    event.preventDefault();

    var form = $(this);
    var formData = form.serialize();
    var url = "{{ route('students.update', ['id' => $student->id]) }}";

    $.ajax({
        type: "PUT",
        url: url,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            $("#output").text(data.res);
        },
        error: function(xhr, status, error) {
            $("#output").text(error);
        }
    });
});

    </script>
</body>
</html>
