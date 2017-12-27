<?php

namespace DreamFactory\Core\Rackspace\Components;

use OpenCloud\Common\Lang;
use OpenCloud\Common\Exceptions;

trait VersionCheckPatch
{
    public function __construct($url, $secret, $options = array())
    {
        // check for supported version
        if (version_compare(PHP_VERSION, '5.3.0') < 0) {
            throw new Exceptions\UnsupportedVersionError(
                sprintf(Lang::translate('PHP version [%s] is not supported'),
                    phpversion()));
        }

        // start processing
        $this->debug(Lang::translate('initializing'));
        $this->url = $url;

        if (!is_array($secret)) {
            throw new Exceptions\DomainError(
                Lang::translate('[secret] must be an array')
            );
        }

        $this->secret = $secret;

        if (!is_array($options)) {
            throw new Exceptions\DomainError(
                Lang::translate('[options] must be an array')
            );
        }

        $this->curl_options = $options;
    }
}