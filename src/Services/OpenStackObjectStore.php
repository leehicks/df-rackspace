<?php
namespace DreamFactory\Core\Rackspace\Services;

use DreamFactory\Core\Services\RemoteFileService;
use DreamFactory\Core\Rackspace\Components\OpenStackObjectStorageSystem;

/**
 * Class OpenStackObjectStore
 *
 * @package DreamFactory\Core\Rackspace\Services
 */
class OpenStackObjectStore extends RemoteFileService
{
    /**
     * {@inheritdoc}
     */
    public function setDriver($config)
    {
        $this->driver = new OpenStackObjectStorageSystem($config);
    }
}