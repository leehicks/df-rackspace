<?php
namespace DreamFactory\Core\Rackspace\Database\Seeds;

use DreamFactory\Core\Database\Seeds\BaseModelSeeder;
use DreamFactory\Core\Models\ServiceType;
use DreamFactory\Core\Rackspace\Components\RackspaceObjectStorageConfig;
use DreamFactory\Core\Rackspace\Services\OpenStackObjectStore;

class DatabaseSeeder extends BaseModelSeeder
{
    protected $modelClass = ServiceType::class;

    protected $records = [
        [
            'name'           => 'ros_file',
            'class_name'     => OpenStackObjectStore::class,
            'config_handler' => RackspaceObjectStorageConfig::class,
            'label'          => 'Rackspace OpenStack Object Storage  service',
            'description'    => 'File service supporting Rackspace OpenStack Object Storage system.',
            'group'          => 'files',
            'singleton'      => 1
        ]
    ];
}