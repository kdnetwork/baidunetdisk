<?php
function cpall($frpath, $topath) {
    $a = glob("{$frpath}/*");
    foreach ($a as $b) {
        $b = substr($b,strlen($frpath));
        if (is_dir("{$frpath}{$b}")) {
            if (!file_exists("{$topath}{$b}")) {
                if (!mkdir("{$topath}{$b}")) {
                    //die("cpall:创建文件夹 {$topath}{$b} 失败\n");
                }
                //else {
                //echo "cpall:{$frpath}{$b} -> {$topath}{$b}\n";
                //}

            }
            cpall("{$frpath}{$b}", "{$topath}{$b}");
        } else {
            if (!copy("{$frpath}{$b}", "{$topath}{$b}")) {
                //die("cpall:复制 {$frpath}{$b} 失败\n");
            }
            //else {
            //echo "cpall:{$frpath}{$b} -> {$topath}{$b}\n";
            //}
        }

    }
}
function delall($frpath) {
    $a = glob("{$frpath}/*");
    foreach ($a as $b) {
        $b = substr($b,strlen($frpath));
        if (is_dir("{$frpath}{$b}")) {
            //echo "delall:{$frpath}{$b}\n";
            delall("{$frpath}{$b}");
            if (!rmdir("{$frpath}{$b}")) {
                //die("delall:删除 {$frpath}{$b} 失败\n");
            }
            //else {
            //echo "delall:{$frpath}{$b}\n";
            //}
        } else {
            if (!unlink("{$frpath}{$b}")) {
                //die("delall:删除 {$frpath}{$b} 失败\n");
            }
            //else {
            //echo "delall:{$frpath}{$b}\n";
            //}
        }

    }
    if (!rmdir("{$frpath}")) {
        //die("delall:删除 {$frpath}{$b} 失败\n");
    }
    //else {
    //echo "delall:{$frpath}{$b}\n";
    //}
}