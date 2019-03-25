
# # 函数
# # 不定长函数（*arrs）
# def gbk_print(str,*arrs):
# 	print str.decode('utf-8').encode('gbk'),
# 	for arr in arrs:
# 		print arr
# 	return 'true'


# # 行内函数
# sum = lambda arg1, arg2: arg1 + arg2;
 
# # 调用sum函数
# gbk_print("相加后的值为 : ", sum( 10, 20 ))
# res=gbk_print("相加后的值为 : ", sum( 20, 20 ))
# print res;

# #引入函数
# import myfunc
# myfunc.gbk_print("相加后的值为 : ", myfunc.sum( 10, 20 ))
# res=myfunc.gbk_print("相加后的值为 : ", myfunc.sum( 20, 20 ))
# print res;

# from myfunc import gbk_print
# from myfunc import sum
# from myfunc import gbk_print,sum
# gbk_print("相加后的值为 : ", sum( 10, 20 ))
# 

# #全局变量
# Money = 2000
# def AddMoney():
#    global Money 		#声明money是全局变量
#    Money = Money + 1
# print Money
# AddMoney()
# print Money

#dir-查看一个模块里定义过的名字
# import math
# content = dir(math)
# print content;
#['__doc__', '__name__', '__package__', 'acos', 'acosh', 'asin', 'asinh', 'atan', 'atan2', 'atanh', 'ceil', 'copysign', 'cos', 'cosh', 'degrees', 'e', 'erf', 'erfc', 'exp', 'expm1', 'fabs', 'factorial', 'floor', 'fmod', 'frexp', 'fsum', 'gamma', 'hypot', 'isinf', 'isnan', 'ldexp', 'lgamma', 'log', 'log10', 'log1p', 'modf', 'pi', 'pow', 'radians', 'sin', 'sinh', 'sqrt', 'tan', 'tanh', 'trunc']


# print __doc__.decode('utf-8').encode('gbk')
# print __name__   #返回 __main__ 表示当前为主函数
# print __package__

# #模块(文件夹下的py)引入
# from package_runoob.runoob1 import runoob1
# from package_runoob.runoob2 import runoob2
# runoob1()
# runoob2()



# 错误机制
# try：
#   # code    #需要判断是否会抛出异常的代码，如果没有异常处理，python会直接停止执行程序
  
# except:  #这里会捕捉到上面代码中的异常，并根据异常抛出异常处理信息
# #except ExceptionName，args：    #同时也可以接受异常名称和参数，针对不同形式的异常做处理
#   # code  #这里执行异常处理的相关代码，打印输出等
  
# else：  #如果没有异常则执行else
#   # code  #try部分被正常执行后执行的代码

# finally：
#   # code  #退出try语句块总会执行的程序