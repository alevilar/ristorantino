/* 
  Module dependencies:
  
  - Express
  - Http (to run Express)
  
  It is a common practice to name the variables after the module name.
  Ex: http is the "http" module, express is the "express" module, etc.
*/
var express = require("express")
  , app = express()
  , http = require("http").createServer(app)
  , io = require("http").createServer(app)
  , io = require('socket.io').listen(2001);

/* Server config */

//Server's IP address
app.set("ipaddr", "127.0.0.1");

//Server's port number 
app.set("port", 3005);

//Tells server to support JSON, urlencoded, and multipart requests
app.use(express.bodyParser());

/* Server routing */

//Handle route "GET /", as in "http://localhost:8080/"
app.get("/", function(request, response) {

  //Show a simple response message
  response.send("Hi! I´m ALESSSS");

});

//Start the http server at port and IP defined before
http.listen(app.get("port"), app.get("ipaddr"), function() {
  console.log("Server up and running. Go to http://" + app.get("ipaddr") + ":" + app.get("port"));
});





io.sockets.on('connection', function (socket) {
  socket.emit('news', { msg: "conecto alguien nuevo" });

  socket.emit('news', { msg: "conecto alguien nuevo" }); // Send message to sender
  socket.broadcast.emit('news', { msg: "conecto alguien nuevo" }); // Send message to everyone BUT sender



  socket.on('text', function (data) {
    socket.emit('text',data); // Send message to sender
    socket.broadcast.emit('text',data); // Send message to everyone BUT sender
  });


  socket.on('disconnect', function () {
    io.sockets.emit('user disconnected');
  });

});






process.on( 'SIGINT', function() {
  console.log( "\nGracefully shutting down from SIGINT (Ctrl-C)" );
  // some other closing procedures go here
  process.exit( );
})