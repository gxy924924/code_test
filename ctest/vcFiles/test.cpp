#include <stdio.h>
#include <locale.h>
#include <wchar.h>

int main()
{
	setlocale(LC_CTYPE, "");
   /* 我的第一个 C 程序 */
   printf("Hello, World（世界，你好）! \n");   
   printf("世界，你好");

   
   return 0;
}