const mongoose = require("mongoose");

//set up Schema
const favouriteSchema = new mongoose.Schema({
  movie: {
    type: mongoose.Schema.Types.ObjectId,
    required: true
  },
  userId: {
    type: String,
    required: true
  }
})

var Favourite = module.exports = mongoose.model('favourite', favouriteSchema);

module.exports.get = function (callback, limit) {
  Favourite.find(callback).limit(limit);
}
