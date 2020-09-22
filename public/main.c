#include <stdio.h>

int main(){

	int x,y,t,i;
	scanf("%d",&t);
	for(i = 1; i <= t; i++)
	{
		scanf("%d%d",&x,&y);
		printf("%d\n",x+y);
	}
	return 0;
}