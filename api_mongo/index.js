const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const path = require('path');

//Init app
const app = express();

//Import routes
const apiRoutes = require('./api-routes');

//Configurations
app.use(bodyParser.urlencoded({
  extended: true
}));
app.use(bodyParser.json());

//Connect to DB
const db_url = "mongodb://mongo_data:27017/movieApp_db";

mongoose.connect(db_url, {useNewUrlParser: true}, (err) => {
  err?
  console.error("Error occured while connecting to db!", err):
  console.log("Database connection established successfully");
});
var db = mongoose.connection;

//Setup server port
const port = process.env.PORT || 8090;

//Default URL message
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname+'/index.html'));
});

//Use API routes in the App
app.use('/api', apiRoutes);

//Listen to specified port
app.listen(port, () => console.log(`App running successfully on port number ${port}...`));
