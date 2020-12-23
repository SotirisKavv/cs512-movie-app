const mongoose = require('mongoose');

//set up schema
const userSchema = new mongoose.Schema({
  name: {
    type: String,
    required: true
  },
  surname: {
    type: String,
    required: true
  },
  username: {
    type: String,
    required: true,
    unique: true
  },
  email: {
    type: String,
    required: true
  },
  role: {
    type: String,
    enum: ["ADMIN", "CINEMAOWNER", "USER"],
    required: true
  }
});

var User = module.exports = mongoose.model('user', userSchema);

module.exports.get = function (callback, limit) {
  User.find(callback).limit(limit);
}
