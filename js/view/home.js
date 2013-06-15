var HomeView = Backbone.View.extend({
    render: function() {
        this.getPopularMovies();
    },
    getPopularMovies: function() {
        $.get(App.REST_URL, {
            request: 'popularMovies'
        }, function(data, status, jq) {
            var movies = data;
            var carouselItems = [];
            $.each(movies, function(i, movie){
                var caption = '<div class="carousel-caption"><h4>' + movie.movie.title + '</h4><p>' + movie.details.overview + '</p></div>';
                var html = '<div class="item' + (i === 0 ? " active" : "") +'" data-id="' + movie.movie.id + '"><img src="' + movie.images.backdrop + '"></img>' + caption + '</div>';
                carouselItems.push(html)
            });


            $('#myCarousel .carousel-inner').html(carouselItems.join(''));
            $('#myCarousel').on('click', '.item', function(e) {
                AppRouter.navigate('movie/' + $(e.currentTarget).data().id, true);
            });
            $('#myCarousel').carousel();
        });
    }
})