<?php
namespace DreamFactory\Core\Rackspace\Components;

use DreamFactory\Core\File\Models\FilePublicPath;
use DreamFactory\Core\Rackspace\Models\OpenStackConfig;
use DreamFactory\Library\Utility\ArrayUtils;

class OpenStackObjectStorageConfig extends OpenStackConfig
{
    /**
     * {@inheritdoc}
     */
    public static function getConfig($id, $protect = true)
    {
        $config = [];

        /** @var OpenStackConfig $rosConfig */
        if (!empty($rosConfig = OpenStackConfig::find($id))) {
            $rosConfig->protectedView = $protect;
            $config = $rosConfig->toArray();
        }

        /** @var FilePublicPath $pathConfig */
        if (!empty($pathConfig = FilePublicPath::find($id))) {
            $config = array_merge($config, $pathConfig->toArray());
        }

        return $config;
    }

    /**
     * {@inheritdoc}
     */
    public static function validateConfig($config, $create = true)
    {
        return (OpenStackConfig::validateConfig($config, $create) && FilePublicPath::validateConfig($config, $create));
    }

    /**
     * {@inheritdoc}
     */
    public static function setConfig($id, $config)
    {
        /** @var OpenStackConfig $rosConfig */
        $rosConfig = OpenStackConfig::find($id);
        /** @var FilePublicPath $pathConfig */
        $pathConfig = FilePublicPath::find($id);
        $configPath = [
            'public_path' => array_get($config, 'public_path'),
            'container'   => array_get($config, 'container')
        ];
        $configRos = [
            'service_id'   => array_get($config, 'service_id'),
            'username'     => array_get($config, 'username'),
            'password'     => array_get($config, 'password'),
            'tenant_name'  => array_get($config, 'tenant_name'),
            'api_key'      => array_get($config, 'api_key'),
            'url'          => array_get($config, 'url'),
            'region'       => array_get($config, 'region'),
            'storage_type' => array_get($config, 'storage_type')
        ];

        ArrayUtils::removeNull($configRos);
        ArrayUtils::removeNull($configPath);

        if (!empty($rosConfig)) {
            $rosConfig->update($configRos);
        } else {
            //Making sure service_id is the first item in the config.
            //This way service_id will be set first and is available
            //for use right away. This helps setting an auto-generated
            //field that may depend on parent data. See OAuthConfig->setAttribute.
            $configRos = array_reverse($configRos, true);
            $configRos['service_id'] = $id;
            $configRos = array_reverse($configRos, true);
            OpenStackConfig::create($configRos);
        }

        if (!empty($pathConfig)) {
            $pathConfig->update($configPath);
        } else {
            //Making sure service_id is the first item in the config.
            //This way service_id will be set first and is available
            //for use right away. This helps setting an auto-generated
            //field that may depend on parent data. See OAuthConfig->setAttribute.
            $configPath = array_reverse($configPath, true);
            $configPath['service_id'] = $id;
            $configPath = array_reverse($configPath, true);
            FilePublicPath::create($configPath);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getConfigSchema()
    {
        $rosConfig = new OpenStackConfig();
        $pathConfig = new FilePublicPath();
        $out = null;

        $rosSchema = $rosConfig->getConfigSchema();
        $pathSchema = $pathConfig->getConfigSchema();

        if (!empty($rosSchema)) {
            $out = $rosSchema;
        }
        if (!empty($pathSchema)) {
            $out = ($out) ? array_merge($out, $pathSchema) : $pathSchema;
        }

        return $out;
    }

    /**
     * {@inheritdoc}
     */
    public static function removeConfig($id)
    {
        // deleting is not necessary here due to cascading on_delete relationship in database
    }

    /**
     * {@inheritdoc}
     */
    public static function getAvailableConfigs()
    {
        return null;
    }
}