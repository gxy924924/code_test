#include <stdio.h>
#include <locale.h>
#include <wchar.h>

int main()
{
	setlocale(LC_CTYPE, "");
   /* �ҵĵ�һ�� C ���� */
   printf("Hello, World�����磬��ã�! \n");   
   printf("���磬���");

   
   return 0;
}