<?php

namespace DreamFactory\Core\Rackspace\Components;

use OpenCloud\Rackspace;

class DfRackspace extends Rackspace
{
    use VersionCheckPatch;
}