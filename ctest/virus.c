/*
龌龊的程序
 */
#include <stdio.h>
#include <windows.h>
#include <malloc.h>
 
int main(void)
{
	int c;
	int i;
	int j;

	nihao:
		// system("chcp 65001");
		// system("chcp 936");
		printf("1:deadline (autoShutDown 'shutdown -a' to release it) \n");
		printf("2:mechine explode (unlimited number of windows(here only five windows open))\n");
		printf("please choose: \n");
		scanf("%d",&c);

		if(c == 1){
			// printf("11111\n");
			// 注意：这里要“-双引号 ，才好使
			system("shutdown -s -t 3600");
		}else if (2 == c){
			printf("you are a bad man , i will punish you! \n");
			for(j=0 ;j<5;++j){
				system("start");
			}
			// printf("2222\n");
		}else{
			printf("wrong input ,please set again \n");
			goto nihao;
		}
	system("pause");
   	return 0;
}