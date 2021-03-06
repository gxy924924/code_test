import re

# print(re.match('www', 'www.runoob.com').span())  # 在起始位置匹配
# print(re.match('com', 'www.runoob.com'))         # 不在起始位置匹配


# print(re.search('www', 'www.runoob.com').span())  # 在起始位置匹配
# print(re.search('com', 'www.runoob.com').span())         # 不在起始位置匹配


# line = "Cats are smarter than dogs"
# matchObj = re.match( r'(.*) are (.*?) .*', line, re.M|re.I)
# if matchObj:
#    print "matchObj.groups()", matchObj.groups()
#    print "matchObj.group() : ", matchObj.group()
#    print "matchObj.group(1) : ", matchObj.group(1)
#    print "matchObj.group(2) : ", matchObj.group(2)
# else:
#    print "No match!!"

# re.match只匹配字符串的开始，如果字符串开始不符合正则表达式，则匹配失败，函数返回None；而re.search匹配整个字符串，直到找到一个匹配。


# line = "Cats are smarter than dogs";
 
# matchObj = re.match( r'dogs', line, re.M|re.I)
# if matchObj:
#    print "match --> matchObj.group() : ", matchObj.group()
# else:
#    print "No match!!"
 
# matchObj = re.search( r'dogs', line, re.M|re.I)
# if matchObj:
#    print "search --> matchObj.group() : ", matchObj.group()
# else:
#    print "No match!!"


# phone = "2004-959-559 # 这是一个国外电话号码"
 
# # 删除字符串中的 Python注释 
# num = re.sub(r'#.*$', "", phone)
# print "电话号码是: ", num
 
# # 删除非数字(-)的字符串 
# num = re.sub(r'\D', "", phone)
# print "电话号码是 : ", num


# # 将匹配的数字乘以 2
# def double(matched):
#     value = int(matched.group('value'))
#     print value
#     return str(value * 2)
 
# s = 'A23G4HFD567'
# print(re.sub('(?P<value>\d+)', double, s))


pattern = re.compile(r'\d+')                    # 用于匹配至少一个数字
m = pattern.match('one12twothree34four')        # 查找头部，没有匹配
print m
m = pattern.match('one12twothree34four', 2, 10) # 从'e'的位置开始匹配，没有匹配
print m
m = pattern.match('one12twothree34four', 3, 10) # 从'1'的位置开始匹配，正好匹配
print m                                         # 返回一个 Match 对象
print m.group(0)
print m.start(0)   # 可省略 0
print m.end(0)     # 可省略 0
print m.span(0)    # 可省略 0
