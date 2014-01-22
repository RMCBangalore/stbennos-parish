#!/bin/bash

bin/mkrev.sh
rev=$(git describe)
tar=aliveparish-$rev.tar
git archive --format=tar --prefix=parish/ $rev > $tar
tar --append --transform "s,^,parish/," --file=$tar VERSION.txt
gzip $tar

