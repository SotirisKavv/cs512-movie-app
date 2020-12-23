const Favourite = require('../models/favouriteModel');
const Movie = require('../models/movieModel');
const mongoose = require('mongoose');

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

  favourite._id = mongoose.Types.ObjectId();
  favourite.userId = req.body.userId;

  Movie.findById(req.body.movieId, (err, movie) => {
    if (err) {
      res.json({
        status: "error",
        message: err,
      });
    }
    favourite.movie = movie._id
    favourite.save((err) => {
      res.json({
        message: 'New Favourite Created!',
        body: favourite
      });
    });
  });
};

//handle delete favourite
exports.delete = function (req, res) {
  Favourite.deleteOne({
    movie: req.params.mid,
    userId: req.params.uid
  }, (err) => {
      if (err) {
        res.json(err);
      }
      res.json({
        status: "success",
        message: 'Favourite deleted!'
      });
  });
};
