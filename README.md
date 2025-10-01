

## This is not production ready!

```php
$data = Cache::remember('kinetic', 600, function () {
    return [
        'opportunities' => Kinetic::opportunity()->all(),
        'filter_opportunities' => Kinetic::opportunity()->all([
            'name' => 'longer', // TODO
            'page' => 0,
            'rows' => 1,
        ]),
        'opportunity' => Kinetic::opportunity()->get(10256269),
        'opportunity_sessions' => Kinetic::opportunity()->sessions(10256269)->all(),
        'volunteers' => Kinetic::volunteer()->all(),
        'volunteer' => Kinetic::volunteer()->get(691677), 
//                'providers' => Kinetic::provider()->all(), // TODO
//                'filter_providers' => Kinetic::provider()->all(['name' => 'Provider']), // TODO
        'provider_activities' => Kinetic::provider()->activities()->all(),
        'provider_activity_for_one' => Kinetic::provider()->activities('50A9D279-8E7A-496F-B88E-E9C1C90E1DD8')->all(),
        'activities' => Kinetic::providerActivity()->all(),
    ];
});
```
