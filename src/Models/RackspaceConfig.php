<?php
namespace DreamFactory\Core\Rackspace\Models;

use DreamFactory\Core\Models\BaseServiceConfigModel;
use DreamFactory\Core\Exceptions\BadRequestException;

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

    /**
     * {@inheritdoc}
     */
    public static function validateConfig($config, $create = true)
    {
        $validator = static::makeValidator($config, [
            'username'     => 'required',
            'password'     => 'required',
            'tenant_name'  => 'required',
            'api_key'      => 'required',
            'url'          => 'required',
            'region'       => 'required',
            'storage_type' => 'required'
        ], $create);

        if ($validator->fails()) {
            $messages = $validator->messages()->getMessages();
            throw new BadRequestException('Validation failed.', null, null, $messages);
        }

        return true;
    }

    /**
     * @param array $schema
     */
    protected static function prepareConfigSchemaField(array &$schema)
    {
        parent::prepareConfigSchemaField($schema);

        switch ($schema['name']) {
            case 'region':
                $schema['type'] = 'picklist';
                $schema['values'] = [
                    ['label' => 'Chicago', 'name' => 'ORD', 'url' => 'https://identity.api.rackspacecloud.com'],
                    ['label' => 'Dallas', 'name' => 'DFW', 'url' => 'https://identity.api.rackspacecloud.com'],
                    ['label' => 'London', 'name' => 'LON', 'url' => 'https://lon.identity.api.rackspacecloud.com'],
                ];
                $schema['description'] = 'Select the region to be accessed by this service connection.';
                break;
            case 'key':
                $schema['label'] = 'Access Key ID';
                $schema['description'] = 'An AWS account root or IAM access key.';
                break;
            case 'secret':
                $schema['label'] = 'Secret Access Key';
                $schema['description'] = 'An AWS account root or IAM secret key.';
                break;
        }
    }

}