const Favourite = require('../models/favouriteModel');

//handle find user's favourites actions
exports.favourites = function (req, res) {
  Favourite.find({userId: req.params.uid})
  .populate('movie')
  .exec((err, favourites) => {
    if (err) {
      res.json({
        status: "error",
        message: err,
      });
    }
    res.json({
      status: "success",
      message: "Favourites retrieved succesfully",
      body: favourites
    });
  });
};

//handle create favourite actions
exports.new = function (req, res) {
  var favourite = new Favourite();

  favourite.movie = req.params.movieId;
  favourite.userId = req.params.userId;

  favourite.save((err) => {
    res.json({
      message: 'New Favourite Created!',
      body: favourite
    });
  });
};

//handle delete favourite
exports.delete = function (req, res) {
  Favourite.remove({
    movieId: req.params.mid,
    userId: req.params.uid
  }, (err, favourite) => {
    if (err) {
      res.json(err);
    }
    res.json({
      status: "success",
      message: 'Favourite deleted!'
    });
  });
};
