const Koa = require('koa')
const app = new Koa()
var aa = 111;
var v1 = 1

// 洋葱模型
//中间件（最外层）
app.use( async(ctx,next) =>{
    // console.log(1+'start')
    // 获取host信息
    hostname = ctx.header.host
    if(hostname == 'localhost:2000'){
        ctx.body = hostname + "\r\n"
        await next()
    }else{
        ctx.body = 'wrong'
    }
    // console.log(1)
})

//中间件（中间层）
app.use( async(ctx,next) => {
    // console.log(2+'start')
    ctx.body += await mName()
    await next()
    // ctx.body += "bbb"
    // console.log(2)
})

//中间件（内层）
app.use(async (ctx, next) => {
    // console.log(3+'start')
    console.log("统计数:" + (v1++))
    // console.log(3)
})

app.listen(2000)
console.log("demo in run")

// async 与 await 是一对，任何一个async方法才能使用await 非async方法不可以加await
async function mName() {
    return await getName(v1)
}

async function getName() {
    return new Promise((resolve, reject) => {
        resolve('返回值'+v1)
    })
}


/**
 * async 与 await 错误例子
function mName() {
    return await getName()
}
*/ 
//async await promise (三个好兄弟)



