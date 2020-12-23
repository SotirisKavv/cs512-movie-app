const router = require('express').Router();

router.get('/', (req, res) => {
  res.json({
    status: 'API working',
    message: 'Welcome to Movie App API!'
  });
});

//import user controller
const userController = require('./controllers/userController');

router.route('/users')
  .get(userController.index)
  .post(userController.new);

router.route('/users/:id')
  .get(userController.view)
  .put(userController.update)
  .delete(userController.delete);

router.route('/user/:username')
    .get(userController.viewUsr)

//import cinema controller
const cinemaController = require('./controllers/cinemaController');

router.route('/cinemas')
  .get(cinemaController.index)
  .post(cinemaController.new);

router.route('/cinemas/owner/:ownerId')
  .get(cinemaController.own);

router.route('/cinemas/movies/owner/:ownerId')
  .get(cinemaController.movies);

router.route('/cinemas/movies')
  .get(cinemaController.all);

router.route('/cinemas/:id')
  .get(cinemaController.view)
  .put(cinemaController.update)
  .delete(cinemaController.delete);

//import cinema controller
const movieController = require('./controllers/movieController');

router.route('/movies')
  .get(movieController.index)
  .post(movieController.new);

router.route('/movies/search/:key')
  .get(movieController.search);

router.route('/movies/today')
  .get(movieController.today);

router.route('/movies/cinema/:cid')
  .get(movieController.cinema);

router.route('/movies/:id')
  .get(movieController.view)
  .put(movieController.update)
  .delete(movieController.delete);

//import favourites controller
const favouriteController = require('./controllers/favouriteController');

router.route('/favourites')
  .post(favouriteController.new);

router.route('/favourites/:uid')
  .get(favouriteController.favourites);

router.route('/favourites/:uid/:mid')
  .delete(favouriteController.delete);

module.exports = router;
