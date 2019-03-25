const Koa = require('koa')
const app = new Koa()

var v1 = 1

app.use(async (ctx, next) => {
    if ('localhost:8088' == ctx.header.host) {
        await next();
    } else {
        ctx.body = '非法操作'
    }
})

app.use(async (ctx, next) => {
    ctx.body = await mName()
    next()
})

app.use(async (ctx, next) => {
    console.log("统计数:" + (v1++))
})
async function mName() {
    return await getName()
}
async function getName() {
    return new Promise((resolve, reject) => {
        
        resolve('返回值')
    })
}

//async await Promise

app.listen(8088)
console.log("demo in run")
