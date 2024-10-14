#!/bin/bash
cloc ../ | grep -v "github.com" > cloc.txt
