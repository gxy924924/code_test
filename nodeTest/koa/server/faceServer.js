
module.exports = {
    async qd1(ctx) {
        // console.log(ctx)
        ctx.body = 'server qd1';
        let a1 = f1();
        console.log(a1);

        let a2 = f2();
        console.log(a2);

        let a3 = f3();
        console.log(a3);
        
        let a1_say = 'a1:'+ await a1;
        console.log(a1_say);

        let a2_say = 'a2:'+ await a2;
        console.log(a2_say);

        let a3_say = 'a3:'+ await a3;
        console.log(a3_say);

        ctx.body += a1;
        ctx.body += a2;
        ctx.body += a3;

    }
}


async function f1() {
    return new Promise((resolve, reject) => {
        setTimeout(function () {
            resolve("Hello 1");
        }, 1000);
    })
}

async function f2() {
    return new Promise((resolve, reject) => {
        setTimeout(function () {
            resolve("Hello 2");
        }, 1000);
    })
}

async function f3() {
    return new Promise((resolve, reject) => {
        setTimeout(function () {
            resolve("Hello 3");
        }, 1000);
    })
}


// var f1 = new Promise(function (resolve) {
//     setTimeout(function () {
//         resolve("Hello");
//     }, 3000);
// });



