const superagent = require('superagent');
const cheerio = require('cheerio');
const async = require('async');
const fs = require('fs');
const url = require('url');
const request =require('request');

 
var html = ` <tr>
<td>
<div class="subhead">
<span>女票要晒腿，来给她打分吧</span>&nbsp;由  &nbsp;呆呆分不清&nbsp;发表在<a class="" target="_blank" href="https://bbs.hupu.com/all-gambia">虎扑步行街</a>·<a href="/selfie">爆照区</a>
<a href="/selfie">https://bbs.hupu.com/selfie</a></div>
<div class="quote-content">
<p><img src="https://i10.hoopchina.com.cn/hupuapp/bbs/177575178927682/thread_177575178927682_20190116114442_s_44896_w_480_h_360_63372.jpg?x-oss-process=image/resize,w_800/format,webp" data-w="480" data-h="360" data-imgid="ebd3be598edf32479d0882ddf963c4b3"><a target="_blank" class="downimg" download="https://i10.hoopchina.com.cn/hupuapp/bbs/177575178927682/thread_177575178927682_20190116114442_s_44896_w_480_h_360_63372.jpg" href="https://i10.hoopchina.com.cn/hupuapp/bbs/177575178927682/thread_177575178927682_20190116114442_s_44896_w_480_h_360_63372.jpg" style="position: absolute; width: 142px; height: 38px; border-radius: 6px; text-align: center; line-height: 38px; color: rgb(255, 255, 255); background: rgba(0, 0, 0, 0.6); margin-left: -152px; visibility: hidden; display: inline-block; font-size: 14px; margin-top: 1%; z-index: 999;">保存图片</a></p><p><img src="https://i10.hoopchina.com.cn/hupuapp/bbs/177575178927682/thread_177575178927682_20190116114442_s_184578_w_1080_h_1440_75056.jpg?x-oss-process=image/resize,w_800/format,webp" data-w="1080" data-h="1440" data-imgid="e795375fc32a68153328b4f3d3dfb4c6"></p>
<br><small class="f999"><a style="color:#999" href="https://mobile.hupu.com/?_r=bbsvia10" target="_blank">发自虎扑iPhone客户端</a></small>
</div>
</td>
</tr>
    `;

        // cheerio  nodejs版的JQ 
        let $ = cheerio.load(html);
        // $('a').each(function(idx,element){
        //     console.log(idx);
        //     console.log($(element).attr('href'));
        //     // console.log(element);

        // })


        $('p').each(function (idx,element){
            console.log($(this).find('img').attr('src'));
            console.log("\n\r");
            // console.log($(this).find('img'));
        });
        // console.log($('p'))

        // $('p').find('img').each(function(idx,element){
        //     console.log(idx);
        //     console.log($(element).attr('src'));
        //     // console.log(element);
        // })






// for (let i = 1; i <= 4; i++) {
//     hupuUrl2 = 'https://bbs.hupu.com/selfie-' + i;
// //for循环把五页的页面循环出来
//     superagent.get(hupuUrl2)
// //通过superagent去请求每一页
//         .end(function (err, res) {
//             if (err) {
//                 return console.error(err);
//             }
// //cheerio  nodejs版的JQ 
//             let $ = cheerio.load(res.text);
// //获取首页所有的链接
//             $('.titlelink>a:first-child').each(function (idx, element) {
//                 let $element = $(element);
//                 let href = url.resolve(hupuUrl2, $element.attr('href'));
//                 allUrl.push(href);
//                 curCount++;
// //获取到此url，异步进行以下操作，此操作为进入到这个帖子中爬取数据
//                 superagent.get(href)
//                     .end(function (err, res) {
//                         if(err){
//                             return console.error(err);
//                         }
//                         let $ = cheerio.load(res.text);
//                         let add = href;
//                         let title = $('.bbs-hd-h1>h1').attr('data-title');//帖子标题
//                         let tximg = $('.headpic:first-child>img').attr('src');//用户头像
//                         let txname = $('.j_u:first-child').attr('uname');//用户ID
//                         let contentimg1 = $('.quote-content>p:nth-child(1)>img').attr('src');//爆照图1
//                         let contentimg2 = $('.quote-content>p:nth-child(2)>img').attr('src');//爆照图2
//                         let contentimg3 = $('.quote-content>p:nth-child(3)>img').attr('src');//爆照图3
//                         ssr.push({
//                             'tx': tximg,
//                             'name': txname,
//                             'pic': contentimg1,contentimg2,contentimg3
//                         });
// //把数据存储到一个对象里
//                         let stad = {
//                             "address": add,
//                             "title":title,
//                             "ID" : txname,
//                             "touxiang" : tximg,
//                             "pic1" : contentimg1,
//                             "pic2" : contentimg2,
//                             "pic3" : contentimg3
//                         };
//                         let picArr = [contentimg1,contentimg2,contentimg3];
//                         //console.log(stad);
// //通过fs模块把数据写入本地json
//                         fs.appendFile('data/result1.json', JSON.stringify(stad) ,'utf-8', function (err) {
//                             if(err) throw new Error("appendFile failed...");
//                             //console.log("数据写入success...");
//                         });
// //定义一个以title为文件夹名的路径，作为以后下载图片时使用
//                         let lujin = 'data/' + title + '/';
// //判断文件夹是否存在
//                         fs.exists('data/111',function (exists) {
//                             if(!exists){
//                                 fs.mkdir("data/111", function(err) {
//                                     if (err) {
//                                         throw err;
//                                     }
//                                     async.mapSeries(picArr,function(item, callback){
//                                         setTimeout(function(){
// //downloadPic方法下载图片
//                                             downloadPic(item, 'data/'+ (new Date()).getTime() +'.jpg');
//                                             callback(null, item);
//                                         },400);
//                                     }, function(err, results){});
//                                 });
//                                 console.log('ye')
//                             }else {
//                                 console.log('er')
//                             }
//                         })
//                     })
//             });
//         });
// }