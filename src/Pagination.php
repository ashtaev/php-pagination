<?php

namespace ashtaev;

class Pagination {


    private static function head() {
        echo '<!-- Pagination -->' . PHP_EOL;
        echo '<nav aria-label="Page navigation example">' . PHP_EOL;
        echo "\t" . '<ul class="pagination my-4">' . PHP_EOL;
    }



    private static function disable(String $i) {
        echo "\t\t" . '<li class="page-item disabled"><a class="page-link" href="#">' . $i . '</a></li>' . PHP_EOL;
    }



    private static function enable(String $path, $i) {
        echo "\t\t" . '<li class="page-item"><a class="page-link" href="' . static::url($path, $i) . '">' . $i . '</a></li>' . PHP_EOL;
    }



    private static function footer() {
        echo "\t" . '</ul>' . PHP_EOL;
        echo '</nav>' . PHP_EOL;
        echo '<!--// Pagination -->' . PHP_EOL;
    }
    
    

    public static function run(Int $total, Int $list, Int $page, String $path, Int $size = 6) {


        $link = $total % $list == 0 ? $link = $total/$list : $link = ceil($total/$list);

        if ($link === 1) return 0;

        self::head();

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
        self::footer();

        return 0;
    }

    protected static function url($path, $i = 1) {

    }

}
