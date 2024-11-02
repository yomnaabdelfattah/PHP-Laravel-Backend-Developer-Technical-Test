<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Posts</h1>
        <div id="posts"></div> <!-- Container for posts -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch posts from the API
            $.ajax({
                url: '/api/posts',
                method: 'GET',
                success: function(data) {
                    // Clear the posts container
                    $('#posts').empty();

                    // Loop through the posts and display them
                    $.each(data, function(index, post) {
                        $('#posts').append(`
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">${post.title}</h5>
                                    <p class="card-text">${post.content}</p>

                                    <h6>Comments:</h6>
                                    <ul>
                                        ${post.comments.map(comment => `<li>${comment.content}</li>`).join('')}
                                    </ul>
                                </div>
                            </div>
                        `);
                    });
                },
                error: function(error) {
                    console.log('Error fetching posts:', error);
                }
            });
        });
    </script>
</body>
</html>
