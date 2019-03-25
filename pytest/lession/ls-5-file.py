# # 普通获取输入并输出返回
# str = raw_input("请输入：".decode('utf-8').encode('gbk'))
# print "你输入的内容是: ".decode('utf-8').encode('gbk'), str

# # 可执行的输入并输出返回
# str = input("请输入（输入的内容会被编译执行）：".decode('utf-8').encode('gbk'))
# print "你输入的结果是: ".decode('utf-8').encode('gbk'), str

# 打开一个文件
# fo = open("myfunc.py")
# print "文件名: ".decode('utf-8').encode('gbk'), fo.name
# print "是否已关闭 : ".decode('utf-8').encode('gbk'), fo.closed
# print "访问模式 : ".decode('utf-8').encode('gbk'), fo.mode
# print "末尾是否强制加空格 : ".decode('utf-8').encode('gbk'), fo.softspace
# print fo.read().decode('utf-8').encode('gbk')

# 查找当前位置
# position = fo.tell()
# print "当前文件位置 : ".decode('utf-8').encode('gbk') , position
# print fo.read(32).decode('utf-8').encode('gbk') 		#读取部分
# 
# seek（offset [,from]）方法改变当前文件的位置。Offset变量表示要移动的字节数。From变量指定开始移动字节的参考位置。
# 如果from被设为0，这意味着将文件的开头作为移动字节的参考位置。
# 如果设为1，则使用当前的位置作为参考位置。如果它被设为2，那么该文件的末尾将作为参考位置。
# 
# # 把指针再次重新定位到文件开头
# position = fo.seek(0, 0)
# str = fo.read(10)
# print "重新读取字符串 : ", str
# 关闭打开的文件
# fo.close()
# 
# file=open('test.txt','w+');
# print file;
# 
# 
# import os, sys
# now_dir = os.getcwd()  			# 返回当前目录位置
# ret=os.listdir(now_dir) 		#返回目录文件下所有文件和文件夹
# print ret;

# os.remove(file) 					#函数用来删除一个文件:
# os.removedirs（r"c：\python"） #删除多个目录：

# F_OK=os.access(now_dir,os.F_OK );   #使用当前的uid/gid尝试访问路径
# R_OK=os.access(now_dir,os.R_OK );   #使用当前的uid/gid尝试访问路径
# W_OK=os.access(now_dir,os.W_OK );   #使用当前的uid/gid尝试访问路径
# X_OK=os.access(now_dir,os.X_OK );   #使用当前的uid/gid尝试访问路径

# 		# os.F_OK: 作为access()的mode参数，测试path是否存在。
# 		# os.R_OK: 包含在access()的mode参数中 ， 测试path是否可读。
# 		# os.W_OK 包含在access()的mode参数中 ， 测试path是否可写。
# 		# os.X_OK 包含在access()的mode参数中 ，测试path是否可执行。

# print F_OK
# print R_OK
# print W_OK
# print X_OK

# isfile=os.path.isfile(now_dir)
# print isfile
# isdir=os.path.isdir(now_dir)
# print isdir

# isabs=os.path.isabs(now_dir)
# print isabs
# isabs=os.path.isabs('./')
# print isabs

# exists=os.path.exists(now_dir)
# print exists
# 
fp=open('test111.txt','a+');

str='this is test info ,hello hello\n'
res=fp.write(str)      
position = fp.seek(0, 0)
res2=fp.read()      
print res2

