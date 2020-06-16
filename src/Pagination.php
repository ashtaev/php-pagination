<?php

namespace ashtaev;

class Pagination {

    public $pages = Array();

    /**
     * Get an array of paginated page data.
     *
     * @param int $total The total number of items
     * @param int $page The current page number
     * @param string $path A URL for each page
     * @param int $list The number of items per page
     * @param int $size Range
     * @return array|bool
     */
    public function get($total, $page, $path, $list = 10, $size = 6) {

        $link = $total % $list == 0 ? $total/$list : ceil($total/$list);

        if ($link === 1) return false;
        $x = $size;
        $total_x = $x * 2 + 1;

        if ($link <= $total_x) {
            for ($i = 1; $i <= $link; $i++) {
                switch ($i) {
                    case $page:
                        $this->disable($i);
                        break;
                    case 1:
                        $this->enable($path, 1);
                        break;
                    default:
                        $this->enable($path, $i);
                }
            }
        } else {
            if ($x + 1 >= $page) {
                for ($i = 1; $i <= $total_x - 2; $i++) {
                    switch ($i) {
                        case $page:
                            $this->disable($i);
                            break;
                        case 1:
                            $this->enable($path, 1);
                            break;
                        default:
                            $this->enable($path, $i);
                    }
                }
                $this->disable("…");
                $this->enable($path, $link);
            } elseif ($page < $link - $x) {
                $this->enable($path, 1);
                $this->disable("…");
                for ($i = $page - $x + 2; $i != $page; $i++) {
                    $this->enable($path, $i);
                }
                $this->disable($i);
                for ($i = $page + 1; $i <= $page + $x - 2; $i++) {
                    $this->enable($path, $i);
                }
                $this->disable("…");
                $this->enable($path, $link);
            } else {
                $this->enable($path, 1);
                $this->disable("…");
                for ($i = $link - $total_x + 3; $i <= $link; $i++) {
                    switch ($i) {
                        case $page:
                            $this->disable($i);
                            break;
                        case 1:
                            $this->enable($path, 1);
                            break;
                        default:
                            $this->enable($path, $i);
                    }
                }
            }
        }
        return $this->pages;
    }

    /**
     * @param int $i
     */
    private function disable($i) {
        $pp['num'] = $i;
        $pp['url'] = false;
        $this->pages[] = $pp;
    }

    /**
     * @param string $path
     * @param int $i
     */
    private function enable($path, $i) {
        $pp['num'] = $i;
        $pp['url'] = $this->url($path, $i);
        $this->pages[] = $pp;
    }

    /**
     * @param string $path
     * @param int $i
     * @return string
     */
    protected function url($path, $i = 1) {
        return str_replace("[:page]", $i, $path);
    }
}