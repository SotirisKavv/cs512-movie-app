const User = require('../models/userModel');

//handle index actions
exports.index = function (req, res) {
  User.get((err, users) => {
    if (err) {
      res.json({
        status: "error",
        message: err,
      });
    }
    res.json({
      status: "success",
      message: "Users retrieved succesfully",
      body: users
    });
  });
};

//handle create user actions
exports.new = function (req, res) {
  var user = new User();
  user.username = req.body.username ? req.body.username : user.username;
  user.name = req.body.name;
  user.surname = req.body.surname;
  user.email = req.body.email;
  user.role = req.body.role;

  user.save((err) => {
    res.json({
      message: 'New User Created!',
      body: user
    });
  });
};

//handle view user's infos by id
exports.view = function (req, res) {
  User.findById(req.params.id, (err, user) => {
    if (err)
      res.send(err);
    res.json({
      message: 'User details loading..',
      body: user
    });
  });
};

//handle view user's infos by username
exports.viewUsr = function (req, res) {
  User.find({username: req.params.username}, (err, user) => {
    if (err)
      res.send(err);
    res.json({
      message: 'User details loading..',
      body: user
    });
  });
};

//handle update user info
exports.update = function (req, res) {
  User.findById(req.params.id, (err, user) => {
    if (err) {
      res.json(err);
    }

    user.username = req.body.username ? req.body.username : user.username;
    user.name = req.body.name;
    user.surname = req.body.surname;
    user.email = req.body.email;
    user.role = req.body.role;

    user.save((err) => {
      if (err) {
        res.json(err);
      }
      res.json({
        message: 'User info updated',
        body: user
      });
    });
  });
};

//handle delete user
exports.delete = function (req, res) {
  User.remove({
    _id: req.params.id
  }, (err, user) => {
    if (err) {
      res.json(err);
    }
    res.json({
      status: "success",
      message: 'User deleted!'
    });
  });
};
