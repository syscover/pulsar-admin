<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Resource;
use Syscover\Admin\Services\ResourceService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class ResourceGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = Resource::class;
    protected $serviceClassName = ResourceService::class;
}