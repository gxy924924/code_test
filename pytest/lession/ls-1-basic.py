
# # 普通输出 与 转码
# print 'aaa你好'.decode('utf-8').encode('gb2312');
# print """你好，这是一个段落。
# 段落在这里。。
#  哈哈哈
# """.decode('utf-8').encode('gb2312');
# raw_input("按下 enter 键退出，\n其他任意键显示...\n".decode('utf-8').encode('gb2312'));
# x='1';y='a';
# # 不换行输出
# print x,
# print y,
# # 不换行输出
# print x,y;

#单行注释
'''多行注释
多行注释
多行注释'''
"""多行注释222
多行注释
多行注释"""

# #读取传入值
# import sys
# print '参数个数为:'.decode('utf-8').encode('gb2312'), len(sys.argv), '个参数。'.decode('utf-8').encode('gb2312');
# print '参数列表:'.decode('utf-8').encode('gb2312'), str(sys.argv);

# #截取字符串
# mystr='1234567890';
# print mystr
# print mystr[0]
# print mystr[2:5]
# print mystr[3:]
# print mystr*2 		# 输出字符串两次
# print mystr+"aaa"

# # 列表
# mylist=['11','aa','33',34]
# tinylist=['tt','vv']
# print mylist
# print mylist[0]
# print mylist[1:3]
# print mylist[2:]
# print tinylist * 2
# print tinylist +mylist

# # 元组（不可再次赋值，相当于只读列表）
# tuple = ( 'runoob', 786 , 2.23, 'john', 70.2 )
# tinytuple = (123, 'john')
# print tuple               # 输出完整元组
# print tuple[0]            # 输出元组的第一个元素
# print tuple[1:3]          # 输出第二个至第三个的元素 
# print tuple[2:]           # 输出从第三个开始至列表末尾的所有元素
# print tinytuple * 2       # 输出元组两次
# print tuple + tinytuple   # 打印组合的元组

# # 字典
# dict = {}
# dict['one'] = "This is one"
# dict[2] = "This is two"
# tinydict = {'name': 'john','code':6734, 'dept': 'sales'}
# print dict['one']          # 输出键为'one' 的值
# print dict[2]              # 输出键为 2 的值
# print tinydict             # 输出完整的字典
# print tinydict.keys()      # 输出所有键
# print tinydict.values()    # 输出所有值