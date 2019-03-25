#!D:\Python27\python.exe
#coding=utf-8

import socket               # 导入 socket 模块

s = socket.socket()         # 创建 socket 对象
host = socket.gethostname() # 获取本地主机名
port = 12345                # 设置端口
s.bind((host, port))        # 绑定端口

s.listen(5)                 # 等待客户端连接
i=1
while i:
    c, addr = s.accept()     # 建立客户端连接。
    print '连接地址：'.decode('utf-8').encode('gbk'), addr
    c.sendall('欢迎访问菜鸟教程！'.decode('utf-8').encode('gbk'))
    c.sendall('你的地址是'.decode('utf-8').encode('gbk'))
    # c.send(addr)
    c.close()                # 关闭连接
    i=i+1
    if(i>2):
    	i=0
    	s.close()
    	print 'close server'
