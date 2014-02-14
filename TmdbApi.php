<?php
	require_once('lib/Rest.inc.php');
	include('lib/TMDb-PHP-API-master/TMDb.php');

	class TmdbApi extends REST {
		const API_KEY = '5ab49e3704cae62363a53aeb317e7635';
		private $tmdb;
        private $tmdbConfig;
		private $query;

		public function __construct() {
			parent::__construct();
			$this->tmdb = new TMDb(self::API_KEY);
            $this->tmdbConfig = $this->tmdb->getConfig();
		}

		public function processApi() {
			$func = strtolower(trim(str_replace('/', '', $_REQUEST['request'])));
			if((int) method_exists($this, $func) > 0) {
				$this->$func();
			} else {
				$this->response('Invalid search', 404);
			}
		}

		public function search() {
			$query = $_REQUEST['query'] ?: '';
            $this->reply(array('actors'=>$this->searchPerson($query), 'movies'=>$this->searchMovie($query)));
		}

		private function searchPerson($query) {
            return $this->tmdb->searchPerson($query);
		}

        private function searchMovie($query) {
            return $this->tmdb->searchMovie($query);
        }

        public function person() {
            //$person = $_REQUEST['item'] ?: null;
            $personId = $_REQUEST['id'];
            $person = $this->tmdb->getPerson($personId);
            $imageUrl = $this->tmdb->getImageUrl($person['profile_path'], TMDb::IMAGE_PROFILE, 'w185');
            //$images = $this->tmdb->getPersonImages($personId);
            $credits = $this->tmdb->getPersonCredits($personId);
            $map = array('person' => $person, 'imageUrl' => $imageUrl, 'credits' => $credits);
            $this->reply($map);
        }

        public function movie() {
            $movieId = $_REQUEST['id'];
            $movie = $this->tmdb->getMovie($movieId);
            $posterImageUrl = $this->tmdb->getImageUrl($movie['poster_path'], TMDb::IMAGE_PROFILE, 'w185');
            $images = array('poster' => $posterImageUrl);
            $map = array('movie' => $movie, 'images' => $images);
            $this->reply($map);
        }

        public function movieDetails($movie) {
            $movieId = $movie['id'];
            $details = $this->tmdb->getMovie($movieId);
            $map = array('movie' => $movie, 'details' => $details);
            return $map;
        }

        public function popularMovies() {
            $data = $this->tmdb->getPopularMovies(1);
            $popMovies = $data['results'];
            $results = array();

            for($i=0, $l=5; $i<$l; $i++) {
                $map = $this->movieDetails($popMovies[$i]);
                $details = $map['details'];
                $backdropImageUrl = $this->tmdb->getImageUrl($details['backdrop_path'], TMDb::IMAGE_BACKDROP, 'w1280');
				
                $images = array('backdrop' => $backdropImageUrl);
                $map['images'] = $images;
                array_push($results, $map);
            }
            $this->reply($results);
        }

        private function reply($payload, $httpCode = 200) {
            $this->response($this->serialize($payload), $httpCode);
        }

		private function serialize($data) {
			return json_encode($data);
		}
	}

	$api = new TmdbApi();
	$api->processApi();
?>