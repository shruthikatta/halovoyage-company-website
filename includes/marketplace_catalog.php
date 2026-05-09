<?php

/**
 * Destination metadata for marketplace JSON (keys must match visit_tracker place names).
 * Star averages and review counts come only from the hub database, not from partner JSON.
 *
 * @return array<string, array{name:string,description:string,category:string,image_url:string,external_url:string}>
 */
function hv_marketplace_destination_catalog(string $origin): array
{
    $o = rtrim($origin, '/');

    return [
        'Paris' => [
            'name' => 'Paris City Tour',
            'description' => 'Explore the romantic city of Paris including the Eiffel Tower, Louvre, Seine River cruise, and world-famous cafes.',
            'category' => 'Destinations',
            'image_url' => $o . '/assets/images/paris.jpg',
            'external_url' => $o . '/products/paris.php',
        ],
        'Bali' => [
            'name' => 'Bali Adventure Trip',
            'description' => 'Waterfalls, jungle temples, rice terraces, and tropical beaches across Bali.',
            'category' => 'Destinations',
            'image_url' => $o . '/assets/images/bali.jpg',
            'external_url' => $o . '/products/bali.php',
        ],
        'Japan' => [
            'name' => 'Japan Sakura Experience',
            'description' => 'Tokyo, Kyoto, and Osaka during cherry blossom season—temples, sushi culture, and spring landscapes.',
            'category' => 'Destinations',
            'image_url' => $o . '/assets/images/japan.jpg',
            'external_url' => $o . '/products/japan.php',
        ],
        'Maldives' => [
            'name' => 'Maldives Luxury Escape',
            'description' => 'Crystal-clear waters, private villas, and world-class diving in the Maldives.',
            'category' => 'Destinations',
            'image_url' => $o . '/assets/images/maldives.jpg',
            'external_url' => $o . '/products/maldives.php',
        ],
        'Alaska' => [
            'name' => 'Alaska Glacier Cruise',
            'description' => 'Glaciers, wildlife, and breathtaking icy landscapes on an Alaska voyage.',
            'category' => 'Tours',
            'image_url' => $o . '/assets/images/alaska.jpg',
            'external_url' => $o . '/products/alaska.php',
        ],
        'Swiss' => [
            'name' => 'Swiss Alps Ski Tour',
            'description' => 'Snowy mountains and alpine villages in the Swiss Alps.',
            'category' => 'Destinations',
            'image_url' => $o . '/assets/images/swiss.jpg',
            'external_url' => $o . '/products/swiss.php',
        ],
        'Dubai' => [
            'name' => 'Dubai Desert Safari',
            'description' => 'Dune bashing and desert luxury in Dubai.',
            'category' => 'Destinations',
            'image_url' => $o . '/assets/images/dubai.jpg',
            'external_url' => $o . '/products/dubai.php',
        ],
        'Thailand' => [
            'name' => 'Thailand Experience',
            'description' => 'Temples, beaches, and vibrant cities across Thailand.',
            'category' => 'Destinations',
            'image_url' => $o . '/assets/images/thailand.jpg',
            'external_url' => $o . '/products/thailand.php',
        ],
        'New York' => [
            'name' => 'New York City Break',
            'description' => 'Iconic sights, Broadway, and skyline views in NYC.',
            'category' => 'Destinations',
            'image_url' => $o . '/assets/images/newyork.jpg',
            'external_url' => $o . '/products/newyork.php',
        ],
    ];
}
