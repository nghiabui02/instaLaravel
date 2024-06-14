

<x-layout>
    <form id="uploadForm" enctype="multipart/form-data">
        @csrf
        <label for="file">Choose a file:</label>
        <input type="file" name="image" id="file">
        <button type="submit">Upload</button>
    </form>
    <div id="response"></div>

    <script>
        const token = localStorage.getItem('token')
        $(document).ready(function(){

            $('#uploadForm').on('submit', function(event){
                event.preventDefault();

                const formData = new FormData(this);
                $.ajax({
                    url: '{{ route('upload') }}',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $('#response').html('<p>File uploaded successfully: ' + data.filename + '</p>');
                    },
                    error: function(xhr){
                        $('#response').html('<p>Error: ' + xhr.responseText + '</p>');
                    }
                });
            });
        });

        $.ajax({
            url: '{{ route('all_file') }}',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            processData: false,
            contentType: false,
            success: function(data){
                if(data.success) {
                    $('#files').empty();
                    $.each(data.images, function(index, file){
                        $('#files').append('<li><a href="' + file + '" target="_blank">' + file + '</a></li>');
                    });
                }
            },
            error: function(xhr){
                $('#response').html('<p>Error: ' + xhr.responseText + '</p>');
            }
        });

    </script>
</x-layout>


