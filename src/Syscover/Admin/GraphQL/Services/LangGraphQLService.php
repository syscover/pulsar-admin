<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Lang;
use Syscover\Admin\Services\LangService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class LangGraphQLService extends CoreGraphQLService
{
    public function __construct(Lang $model, LangService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
