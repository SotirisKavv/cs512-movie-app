const mongoose = require("mongoose");

//set up Schema
const cinemaSchema = new mongoose.Schema({
  _id: mongoose.Schema.Types.ObjectId,
  name: {
    type: String,
    required: true
  },
  ownerId: {
    type: String,
    required: true
  },
  movies: [{
    type:mongoose.Schema.Types.ObjectId,
    ref: 'movie'
  }]
})

var Cinema = module.exports = mongoose.model('cinema', cinemaSchema);

module.exports.get = function (callback, limit) {
  Cinema.find(callback).limit(limit);
}
