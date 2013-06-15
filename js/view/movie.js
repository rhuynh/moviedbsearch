/**
 * Movie view
 * @type {*}
 */
var MovieView = Backbone.View.extend({
    render: function(id) {
        this.getMovieDetails(id);
    },
    getMovieDetails: function(id) {
        $.get(App.REST_URL, {
            request: 'movie',
            id: parseInt(id)
        }, _.bind(function(data, status, jq) {
            var movie = data.movie;
            var container = this.$el;
            container.find('.title').text(movie.title);
            container.find('.description').text(movie.overview || 'No description');
            container.find('.profile-image').attr('src', data.images.poster);
        }, this));
    }
});