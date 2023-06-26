<?php

namespace Davereid\DrupalEnvironment;

/**
 * The standard environment.
 */
class DefaultEnvironment
{

    /**
     * The default environment variable name.
     *
     * @var string
     */
    public const ENVIRONMENT_NAME = 'ENVIRONMENT';

    /**
     * The default production environment name.
     *
     * @var string
     */
    public const PRODUCTION = 'production';

    /**
     * The default staging environment name.
     *
     * @var string
     */
    public const STAGING = 'staging';

    /**
     * The default development environment name.
     *
     * @var string
     */
    public const DEVELOPMENT = 'dev';

    /**
     * The default CI environment name.
     *
     * @var string
     */
    public const CI = 'ci';

    /**
     * Return the environment name.
     *
     * For example: "local" or "ci" or "dev" or "prod".
     *
     * @return string
     *   The name of the environment.
     */
    public static function getEnvironment(): string
    {
        return Environment::get(static::ENVIRONMENT_NAME);
    }

    /**
     * Determine if this is a production environment.
     *
     * @return bool
     *   TRUE if this is a production environment.
     */
    public static function isProduction(): bool
    {
        return static::getEnvironment() === static::PRODUCTION;
    }

    /**
     * Determine if this is a staging environment.
     *
     * @return bool
     *   TRUE if this is a staging environment.
     */
    public static function isStaging(): bool
    {
        return static::getEnvironment() === static::STAGING;
    }

    /**
     * Determine if this is a development/test environment.
     *
     * @return bool
     *   TRUE if this is a development environment.
     */
    public static function isDevelopment(): bool
    {
        return static::getEnvironment() === static::DEVELOPMENT;
    }

    /**
     * Determine if this is a preview environment.
     *
     * @return bool
     *   TRUE if this is a preview environment.
     */
    public static function isPreview(): bool
    {
        return Environment::isTugboat();
    }

    /**
     * Determine if this is a CI environment.
     *
     * @return bool
     *   TRUE if this is CI.
     */
    public static function isCi(): bool
    {
        return static::getEnvironment() === static::CI;
    }

    /**
     * Get the environment_indicator configuration. for this environment.
     *
     * @return array|null
     *   The environment_indicator configuration or NULL if one could not be provided.
     *
     * @see https://architecture.lullabot.com/adr/20210609-environment-indicator/
     */
    public static function getIndicatorConfig(): ?array {
        if (static::isProduction()) {
            return [
                'name' => 'Production',
                'bg_color' => '#ffffff',
                'fg_color' => '#e7131a',
            ];
        }
        if (static::isStaging()) {
            return [
                'name' => 'Staging',
                'bg_color' => '#ffffff',
                'fg_color' => '#b85c00',
            ];
        }
        if (static::isDevelopment()) {
            return [
                'name' => 'Development',
                'bg_color' => '#ffffff',
                'fg_color' => '#307b24',
            ];
        }
        if (static::isPreview()) {
            return [
                'name' => 'Preview',
                'bg_color' => '#ffffff',
                'fg_color' => '#990055',
            ];
        }
        if (static::isCi()) {
            return [
                'name' => 'CI',
                'bg_color' => '#ffffff',
                'fg_color' => '#F2F7F5',
            ];
        }
        if (Environment::isLocal()) {
            return [
                'name' => 'Local',
                'bg_color' => '#ffffff',
                'fg_color' => '#505050',
            ];
        }

        // Unknown environment condition.
        $environment = static::getEnvironment();
        trigger_error("Unknown environment {$environment} in " . __METHOD__, E_USER_WARNING);
        return NULL;
    }

}
