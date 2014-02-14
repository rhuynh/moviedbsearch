var App = (function() {
    function initialize() {
        AppRouter.initialize();
        initializeSearch();
    }

    /**
     * Initialize the search feature
     */
    function initializeSearch() {
        var labelToSearchResultMap;

        var search = _.debounce(function(q, callback) {
            $.get(App.REST_URL, {
                request: 'search',
                query: q
            }, function(data, status, jq) {
                labelToSearchResultMap = {};
                labelToSearchResultMap.actors = {};
                var labels = $(data.actors.results).map(function(i, result) {
                    var key = result.name;
                    labelToSearchResultMap.actors[key] = result;
                    return key;
                });

                labelToSearchResultMap.movies = {};
                $.merge(labels, ($(data.movies.results).map(function(i, result){
                    var key = result.title;
                    labelToSearchResultMap.movies[key] = result;
                    return key;
                })));

                callback(labels);
            });
        }, 500);

        $('#searchMain').typeahead({
            items: 10,
            source: function(query, process) {
                search(query, process);
            },
            updater: function(itemLabel) {
                var item = labelToSearchResultMap.actors[itemLabel] || labelToSearchResultMap.movies[itemLabel];
                var isActorItem = !!labelToSearchResultMap.actors[itemLabel];
                AppRouter.navigate((isActorItem ? 'actor/' : 'movie/') + item.id, true);
            }
        });
    }

    return {
        initialize: initialize,
        REST_URL: 'TmdbApi.php',
        SITE_ROOT: '/'
    }
})();