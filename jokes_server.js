var PROTO_PATH = './protos/jokes.proto';
var _ = require('lodash');
var jokesList = require('./jokes.json');


var grpc = require('grpc');
var protoLoader = require('@grpc/proto-loader');
var packageDefinition = protoLoader.loadSync(
    PROTO_PATH,
    {keepCase: true,
        longs: String,
        enums: String,
        defaults: true,
        oneofs: true
    });
var jokes_proto = grpc.loadPackageDefinition(packageDefinition).Jokes;

/**
 * Implements the SayHello RPC method.
 */
function getJoke(call, callback) {
    if (_.isEmpty(call.request.keyword)) {
        return callback(null, {joke: 'No joke requested'});
    }

    console.log(call.request.keyword);

    let jk = _.find(jokesList, { keyword: call.request.keyword });

    if (!jk || jk.length === 0) {
        return callback({
            code: 400,
            message: "no joke found",
            status: grpc.status.INTERNAL
        });
    }

    callback(null, {joke: jk.joke });
}

function addJoke(call, callback) {
    let joke = call.request.question + '\n' + call.request.punchline;
    let newJoke = {
        keyword: call.request.keyword,
        joke: joke
    };

    jokesList.push(newJoke);

    let totalJokes = jokesList.length;

    callback(null, { message: `added to the list... we now have: ${totalJokes} jokes` });
}

/**
 * Starts an RPC server that receives requests for the Greeter service at the
 * sample server port
 */
function main() {
    var server = new grpc.Server();
    server.addService(jokes_proto.Jokes.service, {getJoke: getJoke, addJoke: addJoke});
    server.bind('0.0.0.0:50051', grpc.ServerCredentials.createInsecure());
    server.start();
}

main();