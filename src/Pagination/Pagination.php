<?php

namespace Vibe\Pagination;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
 * Paginate class to paginate thourgh products.
 */

class Pagination implements ConfigureInterface, InjectionAwareInterface
{
    use InjectionAwareTrait, ConfigureTrait;

    public function renderPagination($tableCount, $offset, $limit, $currentPage, $category, $sort, $search, $di)
    {
        $newLimit = $limit !== 10 ? "&limit=$limit" : null;
        $newCategory = $category !== "all" ? "&category=$category" : null;
        $newSort = $sort !== "id" ? "&sort=$sort" : null;
        $newSearch = $search !== "" ? "&search=$search" : null;

        $pages = ceil($tableCount / $limit);
        $prevlink = ($currentPage > 1) ? "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage - 1) . $newLimit . $newCategory . $newSort. $newSearch . "'>Previus</a></li>" : "";
        $nextlink = ($currentPage < $pages) ? "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage + 1) . $newLimit . $newCategory . $newSort. $newSearch . "'>Next</a></li>" : "";
        $row = "";
        $row .= $prevlink;
        for ($i = 1; $i <= $pages; $i++) {
            $page = $di->get("url")->create("?page=$i$newLimit$newCategory$newSort$newSearch");
            $active = $currentPage == $i ? "active" : "";
            
            $row .= "<li class='page-item $active'><a class='page-link' href='$page'>$i</a></li>";
        }
        $row .= $nextlink;
        return $row;
    }
}
