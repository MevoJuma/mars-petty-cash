// app/Providers/AuthServiceProvider.php

use App\Models\PettyCashRequest;
use App\Policies\PettyCashRequestPolicy;

protected $policies = [
PettyCashRequest::class => PettyCashRequestPolicy::class,
];
