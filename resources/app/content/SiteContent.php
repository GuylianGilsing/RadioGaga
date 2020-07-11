<?php
namespace App\Content;

use Psr\Http\Message\ServerRequestInterface as Request;

class SiteContent
{
    public static function getMainHeaderItems(Request $request)
    {
        $items = [
            '/' => [
                'url' => ServerBase(),
                'displayName' => "Home",
                'isActive' => false
            ],
            '/songs' => [
                'url' => ServerBase().'/songs',
                'displayName' => "Songs",
                'isActive' => false
            ],
            '/artists' => [
                'url' => ServerBase().'/artists',
                'displayName' => "Artists",
                'isActive' => false
            ]
        ];

        // Loop over all items and check if they can be set to active
        foreach($items as $slug => $information)
        {
            // If the slug and the path are the same,
            // then we set the item to active
            if($slug == $request->getUri()->getPath())
                $items[$slug]['isActive'] = true;
        }

        return $items;
    }
}