<?php
namespace DreamFactory\Core\Rackspace\Database\Seeds;

use DreamFactory\Core\Database\Seeds\BaseModelSeeder;

class DatabaseSeeder extends BaseModelSeeder
{
    protected $modelClass = 'DreamFactory\\Core\\Models\\ServiceType';

    protected $records = [
        [
            'name'           => 'ros_file',
            'class_name'     => "DreamFactory\\Core\\Rackspace\\Services\\OpenStackObjectStore",
            'config_handler' => "DreamFactory\\Core\\Rackspace\\Models\\RackspaceObjectStorageConfig",
            'label'          => 'Rackspace OpenStack Object Storage  service',
            'description'    => 'File service supporting Rackspace OpenStack Object Storage system.',
            'group'          => 'files',
            'singleton'      => 1
        ]
    ];
}