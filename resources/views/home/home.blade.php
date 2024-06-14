<x-layout>
    <div id="blogs-container"></div>


    <script>
        const token = localStorage.getItem('token');
        $(document).ready(function() {
            const token = localStorage.getItem('token');
            let blogsArray = [];

            $.ajax({
                url: '{{ route('get_blogs') }}',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                processData: false,
                contentType: false,
                success: function(response){
                    if(response) {
                        blogsArray = response;
                        renderBlogs(blogsArray);
                    }
                },
                error: function(xhr){
                    $('#response').html('<p>Error: ' + xhr.responseText + '</p>');
                }
            });

            function renderBlogs(blogs) {
                $('#blogs-container').empty();
                blogs.forEach(blog => {
                    $('#blogs-container').append(`
                    <div class="blog-post">
                        <h3>${blog.title}</h3>
                        <p>${blog.content}</p>
                        <p>Author: ${blog.name} (@${blog.username})</p>
                        <img src="${blog.image}" alt="${blog.title}" width="200"/>
                        <hr>
                    </div>
                `);
                });
            }
        });
    </script>
</x-layout>
