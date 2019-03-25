/*
龌龊的程序
 */
#include <stdio.h>
#include <math.h>
#include <windows.h>
 
int main(void)
{	
	/*
	 求二元一次方程
	 a*x*x+b*x+c == 0
	 */
	int a=1;
	int b=5;
	int c=3;
	// 这里如果写float 会报warning 丢失精度，写 double 不会
	double delta; //delta
	double x1,x2; //存放两个解

	delta = b*b - 4*a*c;

	if(delta>0){
		// 两个解
		x1=(-b+sqrt(delta))/(2*a);
		x2=(-b-sqrt(delta))/(2*a);
		printf("there are two answer %f ,%f \n", x1,x2);
		// printf("该方程有两个解，%f，%f \n", x1,x2);
	}else if(delta == 0){
		// 一个解
		x1=(-b)/(2*a);
		printf("there is one answer, %f \n", x1);
	}else{
		// 无解
		// printf("该方程有无解");
		printf("there is no answer \n");
	}
	system("pause");
   	return 0;


}