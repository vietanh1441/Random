CFLAGS = -Wall -lm

randomstring: randomstring.o rngs.o
        gcc -o randomstring randomstring.o rngs.o $(CFLAGS)

randomstring.o: rngs.o randomstring.c
        gcc -c randomstring.c $(CFLAGS)

rngs.o: rngs.c rngs.h
        gcc -c rngs.c $(CFLAGS)

all: randomstring

clean:
        rm -f *.o *.gcov *.gcda *.gcno *.so