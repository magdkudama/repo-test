Scraping repository
===================

After cloning the project:

```
cd cloned-project-dir
composer install
php console/application test:scrap
```

Results should look similar to this:

```
{
    "results": [
        {
            "title": "Sainsbury's Apricot Ripe & Ready 320g",
            "description": "by Sainsbury's Ripe and Ready Apricots",
            "size": "39.30kB",
            "unit_price": 3.5
        },
        {
            "title": "Sainsbury's Avocado Ripe & Ready XL Loose 300g",
            "description": "",
            "size": "35.70kB",
            "unit_price": 1.5
        },
        {
            "title": "Sainsbury's Avocado, Ripe & Ready x2",
            "description": "Avocados",
            "size": "44.03kB",
            "unit_price": 1.8
        },
        {
            "title": "Sainsbury's Avocados, Ripe & Ready x4",
            "description": "Avocados",
            "size": "39.32kB",
            "unit_price": 3.2
        },
        {
            "title": "Sainsbury's Conference Pears, Ripe & Ready x4 (minimum)",
            "description": "Conference",
            "size": "39.45kB",
            "unit_price": 2
        },
        {
            "title": "Sainsbury's Kiwi Fruit, Ripe & Ready x4",
            "description": "Kiwi Fruit",
            "size": "39.40kB",
            "unit_price": 1.65
        },
        {
            "title": "Sainsbury's Mango, Ripe & Ready x2",
            "description": "by Sainsbury's Ripe and Ready Mango",
            "size": "39.96kB",
            "unit_price": 2
        },
        {
            "title": "Sainsbury's Nectarines, Ripe & Ready x4",
            "description": "Description\n\nRipe & ready\nGreat to eat now - refrigerate at home\n1 nectarine counts as 1 of your 5 a-day\nSource of vitamin C\n\n\n\nClass 1Film - Plastic - not currently recycled Tray - Paper - widely recycled",
            "size": "38.71kB",
            "unit_price": 3
        },
        {
            "title": "Sainsbury's Peaches Ripe & Ready x4",
            "description": "by Sainsbury's Ripe and Ready Peach",
            "size": "48.63kB",
            "unit_price": 3
        },
        {
            "title": "Sainsbury's Pears, Ripe & Ready x4 (minimum)",
            "description": "Pear",
            "size": "48.12kB",
            "unit_price": 2
        },
        {
            "title": "Sainsbury's Plums Ripe & Ready x5",
            "description": "by Sainsbury's Ripe and Ready Plums",
            "size": "47.53kB",
            "unit_price": 2.5
        }
    ],
    "total": 26.15
}
```

Running tests:

`./vendor/bin/phpunit -c tests`

Enjoy!