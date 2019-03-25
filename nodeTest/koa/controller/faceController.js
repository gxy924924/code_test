const faseSer = require('../server/faceServer');

module.exports = {
    async start(ctx) {

        faseSer.qd1(ctx);
        // console.log(ctx)
        // ctx.body = 1
    }
}