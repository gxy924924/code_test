#!D:\Python27\python.exe
#coding=utf-8
# 引入 CGI 处理模块 
import cgi, cgitb 
import os
import Cookie
# print('Content-type:text/html\n\n')
# print '<center><h2>'
# print 'hello world my python27'
# print '</h2></center>'
print "Content-type:text/html"
print 'Set-Cookie: name=aaa;expires=Wed, 28 Aug 2018 18:30:00 GMT'
print
print "<html>"
print "<head>"
print "<meta charset=\"utf-8\">"
print "<title>菜鸟教程 CGI 测试实例</title>"
print "</head>"
print "<body>"


# # 创建 FieldStorage的实例 
# form = cgi.FieldStorage() 

# # 接收字段数据
# if form.getvalue('google'):
#    google_flag = "是"
# else:
#    google_flag = "否"

# if form.getvalue('runoob'):
#    runoob_flag = "是"
# else:
#    runoob_flag = "否"


# print "<h2> 菜鸟教程是否选择了 : %s</h2>" % runoob_flag
# print form.getvalue('runoob')
# print "<h2> Google 是否选择了 : %s</h2>" % google_flag
# print form.getvalue('google')


if 'HTTP_COOKIE' in os.environ:
    cookie_string=os.environ.get('HTTP_COOKIE')
    # print cookie_string
    c=Cookie.SimpleCookie()
    c.load(cookie_string)
    # print c
    # print '<br>'

    try:
        data=c['name'].value
        print "cookie data: "+data+"<br>"
    except KeyError:
        print "cookie 没有设置或者已过去<br>"

print "</body>"
print "</html>"