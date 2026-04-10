<?php

function track_last_visited($place) {
    if(isset($_COOKIE['visited_places'])) {
        $visited = json_decode($_COOKIE['visited_places'], true);
    } else {
        $visited = [];
    }

    array_unshift($visited, $place);
    $visited = array_unique($visited);
    $visited = array_slice($visited, 0, 5);

    setcookie('visited_places', json_encode($visited), time() + (7*24*60*60), "/");
    $_COOKIE['visited_places'] = json_encode($visited); 
}

function track_most_visited($place) {
    if(isset($_COOKIE['visit_count'])) {
        $counts = json_decode($_COOKIE['visit_count'], true);
    } else {
        $counts = [];
    }

    if(isset($counts[$place])) {
        $counts[$place]++;
    } else {
        $counts[$place] = 1;
    }

    setcookie('visit_count', json_encode($counts), time() + (7*24*60*60), "/");
    $_COOKIE['visit_count'] = json_encode($counts); 
}

function get_last_visited() {
    return isset($_COOKIE['visited_places']) 
        ? json_decode($_COOKIE['visited_places'], true) 
        : [];
}

function get_most_visited() {
    if(isset($_COOKIE['visit_count'])) {
        $counts = json_decode($_COOKIE['visit_count'], true);
        arsort($counts);

        return array_slice(array_keys($counts), 0, 5); 
    }
    return [];
}
?>