var ActorView = Backbone.View.extend({
    render: function(id) {
        this.getActorDetails(id);
    },
    getActorDetails: function(id) {
    $.get(App.REST_URL, {
        request: 'person',
        id: parseInt(id)
    }, _.bind(function(data, status, jq) {
        var actor = data.person;
        $('#actorContainer .title').text(actor.name);
        $('#actorContainer .description').text(actor.biography || 'No description');
        $('#actorContainer .profile-image').attr('src', data.imageUrl);

        // a map of id to movies
        var movieMap = {};
        $(data.credits.cast).each(function(i, cast) {
            movieMap[cast.id] = cast;
        });

        if (!this.filmographyTable) {
            this.filmographyTable = this.setUpFilmographyTable();

            //register this only once
            $('.profile-image').error(function() {
                $(this).attr('src', 'asset/silouhette-of-man-md.png');
            });
        }

        this.filmographyTable.fnClearTable();
        this.filmographyTable.fnAddData(data.credits.cast);
        $('#filmography').off('click', 'button.movie-detail').on('click', 'button.movie-detail', function(e) {
            var movie = movieMap[e.currentTarget.value];
            AppRouter.navigate('/movie/' + movie.id, true);
        });
    }, this));
    },
    setUpFilmographyTable: function() {
        return $('#filmography').dataTable({
            "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "aaSorting": [[
                2, "asc"
            ]],
            aoColumnDefs: [{
                sTitle: 'Title',
                aTargets: [0],
                mData: 'title'
            }, {
                sTitle: 'Character',
                aTargets: [1],
                mData: 'character'
            }, {
                sTitle: 'Release Date',
                aTargets: [2],
                mData: 'release_date'
            }, {
                aTargets: [3],
                mData: 'id',
                bSortable: false,
                mRender: function(value, type, dataSource) {
                    return '<input type="hidden" value="' + value + '"></input><div class="btn-group"><button class="btn preview" disabled="true"><i class="icon-film"></i></button><button class="btn movie-detail" value="' + value +'"><i class="icon-chevron-right"></i></button></div>';
                }
            }]
        });
    }
});