<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/1/18
 * Time: 8:11 AM
 */
include_once 'lib/Cookies.php';

define('MAX_RVIEWS', 5);

class RecentViews
{
    private $recentViews = array(MAX_RVIEWS);
    private $viewName = "";

    function __construct()
    {
        $cn = "TeamAlphaMarktUser";
        if(isset($_COOKIE[$cn])) {
            $replace = array(' ', '.');
            $name = str_replace($replace, '_', $_COOKIE[$cn]);
            $this->viewName = "TeamAlphaMarktRecentViews"."_".$name;
        } else {
            $this->viewName = "TeamAlphaMarktRecentViews";
        }

        if(isset($_COOKIE[$this->viewName]))
        {
            $this->recentViews = explode(',', $_COOKIE[$this->viewName]);
        }
        else{
            $this->recentViews = range(0,4);
        }
    }

    private function remove($productCode)
    {
        $offset = -1;
        for($i=0; $i < MAX_RVIEWS; ++$i)
        {
            if($this->recentViews[$i] == $productCode)
            {
                $offset = $i;
                break;
            }
        }
        if($offset >= 0) {
            for ($i = $offset + 1; $i < MAX_RVIEWS; ++$i) {
                $this->recentViews[$i - 1] = $this->recentViews[$i];
            }
        }
    }

    function put($productCode)
    {
        $this->remove($productCode);

        // shift out one, and drop the oldest
        for($i = MAX_RVIEWS-1; $i > 0; --$i)
        {
            $this->recentViews[$i] = $this->recentViews[$i-1];
        }

        $this->recentViews[0] = intval($productCode);
        $cookVal = implode(',', $this->recentViews);
        setcookie($this->viewName, $cookVal, time() + (86400 * 30), "/");
    }

    function getValues()
    {
        return $this->recentViews;
    }

    function size()
    {
        return count($this->recentViews);
    }

    function get($idx)
    {
        if($idx >= 0 && $idx < count($this->recentViews))
        {
            return $this->recentViews[$idx];
        }

        return -1;
    }

    function viewName()
    {
        return $this->viewName;
    }
}