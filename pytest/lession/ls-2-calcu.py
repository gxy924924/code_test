
# # 类型转换
# print int(3.6)
# print int('5',8)
# print int('0xa',16)
# print int('10',8)

# # 算术运算符
# a = 21;b = 10;c = 0;
# info="的值为：".decode('utf-8').encode('gbk')
# print 'a=',a
# print 'b=',b
# print 'c=',c
# c = a + b
# print "a + b "+info, c
# c = a - b
# print "a - b "+info, c 
# c = a * b
# print "a * b "+info, c 
# c = a / b
# print "a / b "+info, c 
# c = a % b
# print "a % b "+info, c
# # 修改变量 a 、b 、c
# a = 2
# b = 3
# c = a**b 
# print '修改变量 a =2 b=3'.decode('utf-8').encode('gbk')
# print "a**b 幂 - 返回x的y次幂 ".decode('utf-8').encode('gbk')+info, c
# a = 10
# b = 5
# c = a//b 
# print '修改变量 a =10 b=5'.decode('utf-8').encode('gbk')
# print "a//b 取整除 - 返回商的整数部分 ".decode('utf-8').encode('gbk')+info, c
# print '1/float(2)=',1/float(2)

# # 位运算符
# a = 60            # 60 = 0011 1100 
# b = 13            # 13 = 0000 1101 
# c = 0
# a2=bin(a)
# b2=bin(b)
# info="的值为：".decode('utf-8').encode('gbk')
# print "a = 60 (",a2,");b = 13(",b2,");c = 0"
# c = a & b;        # 12 = 0000 1100
# print "a & b ",info, c,"(",bin(c),")"
# c = a | b;        # 61 = 0011 1101 
# print "a | b ",info, c,"(",bin(c),")"
# c = a ^ b;        # 49 = 0011 0001
# print "a ^ b ",info, c,"(",bin(c),")"
# c = ~a;           # -61 = 1100 0011
# print "~a ",info, c,"(",bin(c),")"
# c = a << 3;       # 240 = 1111 0000
# print "a << 3 ",info, c,"(",bin(c),")"
# c = a >> 2;       # 15 = 0000 1111
# print "a >> 2 ",info, c,"(",bin(c),")"

# # 例1：if 基本用法
# flag = False
# name = 'luren'
# if name == 'luren':         # 判断变量否为'python'
#     flag = True          # 条件成立时设置标志为真
#     print 'welcome boss'    # 并输出欢迎信息
# else:
#     print name              # 条件不成立时输出变量名称


# # 多重循环判断素数
# i = 2
# while(i < 100):
# 	j = 2
# 	while(j <= (i/j)):
# 		if not(i%j): break  		#当遇到可整除时跳出
# 		print i,'%',j
#   		j = j + 1
# 	if (j > i/j) : print i, " 是素数".decode('utf-8').encode('gbk') 		#可整除跳出的不会判断为否不能通过，未跳出的会通过
# 	i = i + 1
 
# print "Good bye!"

## continue # 小循环跳过
# for letter in 'Python':     # 第一个实例
#    if letter == 'h':
#       continue 				#跳过小循环（break是跳过大循环）
#    print '当前字母 :'.decode('utf-8').encode('gbk'), letter

# import time;  # 引入time模块
# ticks = time.time()
# print "当前时间戳为:".decode('utf-8').encode('gbk'), ticks
# localtime = time.localtime(time.time())
# print "本地时间为 :".decode('utf-8').encode('gbk'), localtime
# # 格式化成2016-03-20 11:45:39形式
# print time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()) 
# # 格式化成Sat Mar 28 22:24:24 2016形式
# print time.strftime("%a %b %d %H:%M:%S %Y", time.localtime()) 
# # 将格式字符串转换为时间戳
# a = "Sat Mar 28 22:24:24 2016"
# print time.mktime(time.strptime(a,"%a %b %d %H:%M:%S %Y"))

# import calendar
 
# cal = calendar.month(2016, 1)
# print "以下输出2016年1月份的日历:".decode('utf-8').encode('gbk')
# print cal