console.log('start')
const Koa = require('koa');
const app = new Koa();
const bodyParser = require('koa-bodyparser');
const router = require('./router');

// app.use( async(ctx) => {
//     // ctx.body = "hello world"
//     ctx.body = "<html><body> 我是一个页面aaabbb cc </body></html>"
// })

app.use(bodyParser({
    formLimit: 'smb',
    jsonLimit: 'smb',
    textLimit: 'smb',
    enableTypes: ['form','json','text']
}))

app.use(bodyParser());

app.use(router.routes(),router.allowedMethods());

app.listen(1996)
console.log("demo in run")