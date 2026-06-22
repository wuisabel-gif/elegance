<?php
/* Shared content data — used by menu.php and search.php.
 * Each row: [name, price, description, image]. Prices/text may use HTML entities. */
$items = [
    'Section One' => [
        ['Item One', '12', 'Short, concrete description of the item.', 'assets/item-one.jpg'],
        ['Item Two', '14', 'Another concrete line. Keep it specific.', 'assets/item-two.jpg'],
        ['Item Three', '9', 'No filler adjectives. Say what it is.', 'assets/item-three.jpg'],
    ],
    'Section Two' => [
        ['Item Four', '18', 'Describe the thing, not how great it is.', 'assets/item-four.jpg'],
        ['Item Five', '11', 'One vivid detail beats three vague ones.', 'assets/item-five.jpg'],
    ],
];
