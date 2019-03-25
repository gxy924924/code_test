#coding=utf-8
# 函数
# 不定长函数（*arrs）
def gbk_print(str,*arrs):
	print str.decode('utf-8').encode('gbk'),
	for arr in arrs:
		print arr
	return 'true'


# 行内函数
sum = lambda arg1, arg2: arg1 + arg2;

# print __name__ 		#当前不是主函数会显示myfunc