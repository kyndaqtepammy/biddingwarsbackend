const express = require('express'),
http = require('http'), 
app = express(),
server = http.createServer(app),
io = require('socket.io').listen(server),
users = {};   //empty object which will have the user name and other things for private chat


app.get('/', (req, res) => {
	res.send("server is running on port 3000")
});


//if a user connects to server
io.on('connection', (socket)=> {
	console.log('user connected')

	socket.on('join', function(userNickName){
		console.log(userNickName+" :has joined the chat")
		socket.broadcast.emit('userjoinedthechat', userNickName+" :has joined the chat")
	})


	socket.on('messagedetection', (senderNickname, messageContent) =>{      //i think i should make this dynamic
		//the message
		console.log(senderNickname+"says : "+messageContent)
		let message = {"message":messageContent, "senderNickname":senderNickname}
		//send the msg to all users including the sneder using io.emit
		io.emit('message', message)
	}),,

	//disconnect
	socket.on('disconnect', function(userNickName) {
		console.log(userNickName + ' has left')
		socket.broadcast.emit("userdisconnect", ' user has left')
	})

})


server.listen(3000, ()=>{
	console.log('node app is running on port 3000')
});





