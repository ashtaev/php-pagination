<?php

namespace ashtaev;

class Pagination {

    public static $pages = [];


    private static function disable(String $i) {
        $pp['num'] = $i;
        $pp['url'] = false;
        self::$pages[] = $pp;
    }



    private static function enable(String $path, $i) {
        $pp['num'] = $i;
        $pp['url'] = static::url($path, $i);
        self::$pages[] = $pp;
    }



    public static function run(Int $total, Int $list, Int $page, String $path, Int $size = 6) {


        $link = $total % $list == 0 ? $link = $total/$list : $link = ceil($total/$list);

        if ($link === 1) return 0;

        $x = $size;

        $total_x = $x * 2 + 1;

        if ($link <= $total_x) {
            for ($i = 1; $i <= $link; $i++) {
                switch ($i) {
                    case $page:
                        self::disable($i);
                        break;
                    case 1:
                        self::enable($path, 1);
                        break;
                    default:
                        self::enable($path, $i);
                }
            }

        } else {

            if ($x + 1 >= $page) {

                for ($i = 1; $i <= $total_x - 2; $i++) {
                    switch ($i) {
                        case $page:
                            self::disable($i);
                            break;
                        case 1:
                            self::enable($path, 1);
                            break;
                        default:
                            self::enable($path, $i);
                    }
                }
                self::disable("…");
                self::enable($path, $link);

            } elseif ($page < $link - $x) {

                self::enable($path, 1);
                self::disable("…");
                for ($i = $page - $x + 2; $i != $page; $i++) {
                    self::enable($path, $i);
                }
                self::disable($i);
                for ($i = $page + 1; $i <= $page + $x - 2; $i++) {
                    self::enable($path, $i);
                }
                self::disable("…");
                self::enable($path, $link);

            } else {

                self::enable($path, 1);
                self::disable("…");

                for ($i = $link - $total_x + 3; $i <= $link; $i++) {
                    switch ($i) {
                        case $page:
                            self::disable($i);
                            break;
                        case 1:
                            self::enable($path, 1);
                            break;
                        default:
                            self::enable($path, $i);
                    }
                }
            }
        }

        return self::$pages;
    }



    protected static function url($path, $i = 1) {

    }

}
