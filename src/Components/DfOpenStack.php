<?php

namespace DreamFactory\Core\Rackspace\Components;

use OpenCloud\OpenStack;

class DfOpenStack extends OpenStack
{
    use VersionCheckPatch;
}