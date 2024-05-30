$(document).ready(function() {
    $('#search').on('keyup', function() {
        var search = $(this).val();
        
        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: {search: search},
            success: function(response) {
                var articles = JSON.parse(response);
                $('#articles').empty();
                articles.forEach(function(article) {
                    $('#articles').append(`
                        <div class="article">
                            <h2>${article.title}</h2>
                            <p>${article.description}</p>
                            <p>Category: ${article.category}</p>
                        </div>
                    `);
                });
            }
        });
    });
});


$(document).ready(function() {
    $('#createArticleForm').on('submit', function(e) {
        console.log(e);
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: 'create_article.php',
            data: $(this).serialize(),
            success: function(response) {
                $('#response').text(response);
                $('#createArticleForm')[0].reset();
            }
        });
    });
});
