const express = require('express'),
http = require('http'), 
app = express(),
server = http.createServer(app),
io = require('socket.io').listen(server),
mongo = require('mongodb').MongoClient,
username = "";

//connect to mongo db
mongo.connect('mongodb://127.0.0.1:27017/mongochat',process.env.MONGO_URI, {useUnifiedTopology: true}, function(err, database){
	if (err) {
		throw err;
	}
//if a user connects to server
io.on('connection', (socket)=> { 
	//connecting to mongo db
	const chatsdb = database.db('mongochat')
	let chat = chatsdb.collection('chats');
	let rooms =chatsdb.collection('roomIDs');

	//user has come online.consider changing event name to "Online"
	socket.on('join', function(username, receiver, roomId){
		socket.join(roomId);  //creating a rom with usnique username id
		//add the room ID to the database collection "roomIds" if it doesnt exist already
		rooms.find({"roomID":roomId}, {$exists: true}).toArray(function(err, obj){
			if (err) throw err;
			console.log(obj)
			if(!obj){
				rooms.insertOne({"roomID":roomId});
			}
		})
		io.emit('userjoinedthechat', " Online")

	})



	socket.on('fetchChats', function(username){
		//emit all room IDs that have my username as the last bit of the "roomId" string 
		rooms.find({}).project({_id : 0, roomID : 1}).toArray(function(err, res){
			if (err) throw err;
			let roomIDArray = res.map(({ roomID }) => roomID)   //array of all room ids
			let sendersArray = [];
			//check if room ID
			roomIDArray.forEach(function(item, index) {
				roomIDArray.filter(Boolean)
				//todo: the invalid responses are returning undefined. 
				if ( item.split("-")[1] === username )
					if ( item != null) {
						var sender = item.split("-")[0]; // the people that sent me the messages
						sendersArray.push(sender)
					
					}
			})
			io.emit("chatslist", sendersArray)
			console.log(sendersArray)
		})

	})


	//a message has been sent
	socket.on('messagedetection', (senderNickname, receiver, messageContent, timeSent, roomId) =>{     
		console.log(roomId)
		//the message
		let message = {"senderNickname":senderNickname, "messageTo":receiver, "message":messageContent, "time":timeSent, "roomID":roomId}
		var messageArray = []
		messageArray.push(message)
		//send the msg to all users including the sneder using io.emit
		chat.insertOne(message);
		io.to(roomId).emit("fetchmessages", messageArray)
		//socket.broadcast.to(receiver);
	})


	//disconnect
	socket.on('disconnect', function(userNickName) {
		//console.log(userNickName + ' has left')
		socket.broadcast.emit("userdisconnect", ' away')
	})

})
});





app.get('/', (req, res) => {
	//res.send("server is running on port 3000")
});





server.listen(3000, ()=>{
	//console.log('node app is running on port 3000')
});
