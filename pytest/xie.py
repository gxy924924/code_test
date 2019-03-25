#!D:\Python27\python.exe
#coding=utf-8
# 协程测试


import time 
def consumer():    
	r = ''    
	while True:        
		n = yield r        
		if not n:   
			print('not n')         
			return        
		print('[CONSUMER] Consuming %s...' % n)        
		time.sleep(1)        
		r = '200 OK' 

def produce(c):    
	# c.next() 与 next(c) 完全相同
	c.next()     
	n = 0    
	while n < 3:        
		n = n + 1        
		print('[PRODUCER] Producing %s...' % n)        
		r = c.send(n)        
		print('[PRODUCER] Consumer return: %s' % r)    
	c.close()
	
if __name__=='__main__':
        c = consumer()
        produce(c)
