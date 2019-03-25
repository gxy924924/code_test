#!D:\Python27\python.exe
#coding=utf-8

def func1():  # 生成器函数
    print("ok1")
    x = 10  # 函数内局部变量x赋值为10
    print(x)
    x = yield 1  # 这里就是send函数的关键
    # 之前我们创建的生成器，yield左边都是没有值（我现在不是很确定这里是不是应该叫做返回值，那就先用值代替）。
    # 现在我们的x会接收到一个值，这个值是什么，从哪里来的？我们继续看下去
    print(x)
    x = yield x  # 这里试第二个断点
    print(2,x)
    x = yield x  # 这里试第二个断点
 
 
f1 = func1()  # 获取生成器对象

ret1 = next(f1)  # 运行到第一个yield

# ret1 = f1.send(None) #（这一句语句需要全部看完回头再看）当第一次执行生成器的时候，他并没有执行到yield这个位置，所以你一点传值，就会出现问题
# 谁去接收？没有对象接收就会报错，所以第一次如果一定要用send去调用，那就传一个None

print(ret1)  # 打印第一个yield返回的值

#########################################
# 关键点来了
# 我们现在有两个问题，x = yield 1，这个x的值是什么，从哪里来
# 当下面这条语句运行后，他会将x的值赋值为send方法的参数，并且继续执行到下一个yield

ret2 = f1.send('eee')
print(ret2)
 
ret3 = f1.send(None)
print(ret3)

# ok1
# 10
# 1
# eee
# eee
 
# 问题都解决了，然后还有一个顺序的问题，我先把我测试的结论提出来，大家可以自己打断点尝试一下，欢迎拍砖
# f=func1()
# next(f)或者f.send(None) => def func1():
# ......
# x = yield 1 到这里会返回，x的值不变 => f1.send('eee')
# =>x = yield 1 这时候不要去管右边，左边的x被赋值（'eee'）然后继续执行
# 其实只要把yield的左边和右边分开看就行了，他们的触发条件不一样。
# 好了 这篇就到这里了
