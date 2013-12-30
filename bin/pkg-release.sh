#!/bin/bash

bin/mkrev.sh
tag=$(git describe --abbrev=0)
rev=$(git describe --long)
tar=stbennos-$rev.tar
git archive --format=tar --prefix=parish/ $tag > $tar
tar --append --transform "s,^,parish/," --file=$tar VERSION.txt
gzip $tar

