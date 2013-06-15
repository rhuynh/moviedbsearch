/**
 * Manages application routes
 */
var AppRouter = (function() {
    var Router = Backbone.Router.extend({
        routes: {
            '': 'home',
            'actor/:id': 'actor',
            'movie/:id': 'movie',
            //default
            '*actions': 'defaultAction'
        },
        home: function() {
            var view = getCachedView('home', new HomeView({
                el: '#homeContainer'
            }));

            renderView(view);
        },
        actor: function(id) {
            var view = getCachedView('actor', new ActorView({
                el: '#actorContainer'
            }));
            renderView(view, id);
        },
        movie: function(id) {
            var view = getCachedView('movie', new MovieView({
                el: '#movieContainer'
            }));
            renderView(view, id);
        },
        defaultAction: function() {
            console.log('no route');
        }
    });

    var views = {};

    /**
     * Returns a cached view, if exist.  Otherwise, will return and cached the new view.
     * @param viewName
     * @param view
     * @returns {*}
     */
    function getCachedView(viewName, view) {
        return views[viewName] || (views[viewName] = view);
    }

    /**
     * Renders the view onscreen
     * @param view
     */
    function renderView(view) {
        $('.view').css('display', 'none');
        view.$el.css('display', 'block');
        view.render.call(view, Array.prototype.slice.call(arguments, 1));
    }

    var appRouter = new Router();

    /**
     * Initter for the application routers
     */
    function initialize() {
        Backbone.history.start({
            root: App.SITE_ROOT,
            pushState: false
        });
    }

    return {
        initialize: initialize,
        navigate: _.bind(appRouter.navigate, appRouter)
    };
})();