const Movie = require('../models/movieModel');
const Cinema = require('../models/cinemaModel');
const mongoose = require('mongoose');

//handle index actions
exports.index = function (req, res) {
  Movie.get((err, movies) => {
    if (err) {
      res.json({
        status: "error",
        message: err,
      });
    }
    res.json({
      status: "success",
      message: "Movies retrieved succesfully",
      body: movies
    });
  });
};

//handle find movies by cinemaId
exports.cinema = function (req, res) {
  Movie.find({cinema: req.params.cid})
  .populate('cinema')
  .then((movies) => {
    res.json({
      status: "success",
      message: "Movies retrieved succesfully",
      body: movies
    });
  });
};

//handle find movies played today
exports.today = function (req, res) {
  //set today time var
  var now = new Date();
  now.setSeconds(59);
  now.setMinutes(59);
  now.setHours(23);

  //find today
  Movie.find({
    startDate: { $lte : now.toISOString()},
    endDate: { $gte : now.toISOString()}
  }, (err, movies) => {
    if (err) {
      res.json({
        status: "error",
        message: err,
      });
    }
    res.json({
      status: "success",
      message: "Movies retrieved succesfully",
      body: movies
    });
  });
};

exports.search = function (req, res) {
  Movie.find({
    $or: [
      {category: {$regex : `.*${req.params.key}.*`, $options: 'i'}},
      {title: {$regex : `.*${req.params.key}.*`, $options: 'i'}},
      {cinemaName: {$regex : `.*${req.params.key}.*`, $options: 'i'}}
    ]}, (err, movies) => {
    if (err)
      res.send(err);
    res.json({
     status: "success",
     message: "Movies retrieved succesfully",
     body: movies
    });
  });
};

//handle create movie actions
exports.new = function (req, res) {
  var movie = new Movie();

  movie._id = mongoose.Types.ObjectId();
  movie.title = req.body.title;
  movie.releaseYear = req.body.releaseYear;
  movie.posterLink = req.body.posterLink;
  movie.startDate = req.body.startDate;
  movie.endDate = req.body.endDate;
  movie.category = req.body.category;

  Cinema.findById(req.body.cinemaId, (err, cinema) => {
    movie.cinema = cinema._id;
    cinema.movies.push(movie._id);
    cinema.save((err) => {
      movie.save((error) => {
        res.json({
          message: 'New Movie Created!',
          body: movie
        });
      })
    });
  })

};

//handle view movie's infos by id
exports.view = function (req, res) {
  Movie.findById(req.params.id, (err, movie) => {
    if (err)
      res.send(err);
    res.json({
      message: 'Movie details loading..',
      body: movie
    });
  });
};

//handle update movie info
exports.update = function (req, res) {
  Movie.findById(req.params.id, (err, movie) => {
    if (err) {
      res.json(err);
    }

    movie.title = req.body.title ? req.body.title : movie.title;
    movie.releaseYear = req.body.releaseYear;
    movie.posterLink = req.body.posterLink;
    movie.startDate = req.body.startDate;
    movie.endDate = req.body.endDate;
    movie.cinemaId = req.body.cinemaId;

    movie.save((err) => {
      if (err) {
        res.json(err);
      }
      res.json({
        message: 'Movie info updated',
        body: movie
      });
    });
  });
};

//handle delete movie
exports.delete = function (req, res) {
  Movie.remove({
    _id: req.params.id
  }, (err, movie) => {
    if (err) {
      res.json(err);
    }
    res.json({
      status: "success",
      message: 'Movie deleted!'
    });
  });
};
