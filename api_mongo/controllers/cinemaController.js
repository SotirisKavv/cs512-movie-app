const Cinema = require('../models/cinemaModel');
const mongoose = require('mongoose');

//handle index actions
exports.index = function (req, res) {
  Cinema.get((err, cinemas) => {
    if (err) {
      res.json({
        status: "error",
        message: err,
      });
    }
    res.json({
      status: "success",
      message: "Cinemas retrieved succesfully",
      body: cinemas
    });
  });
};

//handle find cinemas by ownerId
exports.own = function (req, res) {
  Cinema.find({ownerId: req.params.ownerId}, (err, cinemas) => {
    if (err) {
      res.json({
        status: "error",
        message: err,
      });
    }
    res.json({
      status: "success",
      message: "Cinemas retrieved succesfully",
      body: cinemas
    });
  });
};

//handle find cinemas with movies by ownerId
exports.movies = function (req, res) {
  Cinema.find({ownerId: req.params.ownerId})
  .populate('movies')
  .then((cinemas) => {
    res.json({
      status: "success",
      message: "Cinemas retrieved succesfully",
      body: cinemas
    });
  });
};

//handle create cinema actions
exports.new = function (req, res) {
  var cinema = new Cinema();

  cinema._id = mongoose.Types.ObjectId();
  cinema.name = req.body.name ? req.body.name : cinema.name;
  cinema.ownerId = req.body.ownerId;

  cinema.save((err) => {
    res.json({
      message: 'New Cinema Created!',
      body: cinema
    });
  });
};

//handle view cinema's infos by id
exports.view = function (req, res) {
  Cinema.findById(req.params.id, (err, cinema) => {
    if (err)
      res.send(err);
    res.json({
      message: 'Cinema details loading..',
      body: cinema
    });
  });
};

//handle update cinema info
exports.update = function (req, res) {
  Cinema.findById(req.params.id, (err, cinema) => {
    if (err) {
      res.json(err);
    }

    cinema.name = req.body.name ? req.body.name : cinema.name;
    cinema.ownerId = req.body.ownerId;

    cinema.save((err) => {
      if (err) {
        res.json(err);
      }
      res.json({
        message: 'Cinema info updated',
        body: cinema
      });
    });
  });
};

//handle delete cinema
exports.delete = function (req, res) {
  Cinema.remove({
    _id: req.params.id
  }, (err, cinema) => {
    if (err) {
      res.json(err);
    }
    res.json({
      status: "success",
      message: 'Cinema deleted!'
    });
  });
};
