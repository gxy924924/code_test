
class Employee:
   '所有员工的基类'
   empCount = 0
 
   def __init__(self, name, salary):
      self.name = name
      self.salary = salary
      Employee.empCount += 1
   
   def displayCount(self):
     print "Total Employee %d" % Employee.empCount
 
   def displayEmployee(self):
      print "Name : ", self.name,  ", Salary: ", self.salary

class Test:
    def prt(self):
        print(self)
        print(self.__class__)



# a= Employee('aaa',12);
# a.displayCount();
# a.displayEmployee();
# b= Employee('bb',332);
# b.displayCount();
# b.displayEmployee();


 
# t = Test()
# # t.prt()
# t.aaa=1 			# py中可以直接创建类属性
# print t.aaa


# print hasattr(t, 'aaa')    # 如果存在 'age' 属性返回 True。
# print getattr(t, 'aaa')    # 返回 'age' 属性的值
# setattr(t, 'age', 8) # 添加属性 'age' 值为 8
# print hasattr(t, 'age')    # 如果存在 'age' 属性返回 True。
# delattr(t, 'age')    # 删除属性 'age'
# print hasattr(t, 'age')    # 如果存在 'age' 属性返回 True。

# __dict__ : 类的属性（包含一个字典，由类的数据属性组成）
# __doc__ :类的文档字符串
# __name__: 类名
# __module__: 类定义所在的模块（类的全名是'__main__.className'，如果类位于一个导入模块mymod中，那么className.__module__ 等于 mymod）
# __bases__ : 类的所有父类构成元素（包含了一个由所有父类组成的元组）
# print "Employee.__doc__:", Employee.__doc__
# print "Employee.__name__:", Employee.__name__
# print "Employee.__module__:", Employee.__module__
# print "Employee.__bases__:", Employee.__bases__
# print "Employee.__dict__:", Employee.__dict__


# print "Test.__doc__:", Test.__doc__

# 引用 ????
# a = 40      # 创建对象  <40>
# b = a       # 增加引用， <40> 的计数
# c = [b]     # 增加引用.  <40> 的计数
# print b
# print c
# del a       # 减少引用 <40> 的计数
# print c
# b = 100     # 减少引用 <40> 的计数
# print c
# c[0] = -1   # 减少引用 <40> 的计数
# print c

# 析构函数
# class Point:
#    def __init__( self, x=0, y=0):
#       self.x = x
#       self.y = y
#    def __del__(self):
#       class_name = self.__class__.__name__
#       print class_name, "销毁"

# pt1 = Point()
# pt2 = pt1
# pt3 = pt1
# print id(pt1), id(pt2), id(pt3) # 打印对象的id
# del pt1
# del pt2
# del pt3

class Parent:        # 定义父类
   parentAttr = 100
   def __init__(self):
      print "调用父类构造函数"
 
   def parentMethod(self):
      print "调用父类方法"
 
   def setAttr(self, attr):
      Parent.parentAttr = attr
 
   def getAttr(self):
      print "父类属性 :", Parent.parentAttr
 
class Child(Parent): # 定义子类
   def __init__(self):
      print "调用子类构造方法"
 
   def childMethod(self):
      print "调用子类方法".decode('utf-8').encode('gbk')
 
# c = Child()          # 实例化子类
# c.childMethod()      # 调用子类的方法
# c.parentMethod()     # 调用父类方法
# c.setAttr(200)       # 再次调用父类的方法 - 设置属性值
# c.getAttr()          # 再次调用父类的方法 - 获取属性值

# 运算符重载
class Vector:
   def __init__(self, a, b):
      self.a = a
      self.b = b
 
   def __str__(self):
      return 'Vector (%d, %d)' % (self.a, self.b)
   
   def __add__(self,other):
      return Vector(self.a + other.a, self.b + other.b)
 
# v1 = Vector(2,10)
# v2 = Vector(5,-2)
# print v1 + v2


# 私有变量
class JustCounter:
    __secretCount = 0  # 私有变量
    publicCount = 0    # 公开变量
 
    def count(self):
        self.__secretCount += 1
        self.publicCount += 1
        print self.__secretCount
    def __paa():
        print 'aa';
    
 
counter = JustCounter()
counter.count()
counter.count()
print counter.publicCount
# counter._JustCounter__paa()
# counter.__paa()
# print counter.__secretCount  # 报错，实例不能访问私有变量
# print counter._JustCounter__secretCount     #这样才能访问

# # 访问私有(_类名__私有方法（变量）名)
# class Runoob:
#     __site = "www.runoob.com"

# runoob = Runoob()
# print runoob._Runoob__site