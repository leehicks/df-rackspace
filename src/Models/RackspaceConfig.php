<?php
namespace DreamFactory\Core\Rackspace\Models;

use DreamFactory\Core\Models\BaseServiceConfigModel;

/**
 * Class RackspaceConfig
 *
 * @package DreamFactory\Core\Rackspace\Models
 */
class RackspaceConfig extends BaseServiceConfigModel
{
    protected $table = 'rackspace_config';

    protected $encrypted = ['password', 'api_key'];

    protected $fillable = [
        'service_id',
        'username',
        'password',
        'tenant_name',
        'api_key',
        'url',
        'region',
        'storage_type'
    ];
}