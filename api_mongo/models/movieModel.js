const mongoose = require("mongoose");

//set up Schema
const movieSchema = new mongoose.Schema({
  _id: mongoose.Schema.Types.ObjectId,
  title: {
    type: String,
    required: true
  },
  releaseYear: {
    type: Number,
    required: true
  },
  posterLink: String,
  startDate: {
    type: Date,
    default: Date.now,
    required: true
  },
  endDate: {
    type: Date,
    required: true
  },
  category: {
    type: String,
    required: true
  },
  cinema: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'cinema',
    required: true
  }
})

var Movie = module.exports = mongoose.model('movie', movieSchema);

module.exports.get = function (callback, limit) {
  Movie.find(callback).limit(limit);
}
