#!D:\Python27\python.exe
#coding=utf-8

# HTTP 头部
print "Content-Disposition: attachment; filename=\"test.txt\"";
print
# 打开文件
fo = open("test.txt", "rb")

str = fo.read();
print str

# 关闭文件
fo.close()