const Koa = require('koa')
const app = new Koa()

app.use( async(ctx) => {
    // ctx.body = "hello world"
    ctx.body = "<html><body> 我是一个页面aaabbb cc </body></html>"
})
app.listen(1996)
console.log("demo in run")
