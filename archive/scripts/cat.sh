#!/bin/bash
find ../public ../src -type f -exec cat {} + > all_files_content.txt
