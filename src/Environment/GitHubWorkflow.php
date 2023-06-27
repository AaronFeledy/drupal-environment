<?php

namespace Davereid\DrupalEnvironment\Environment;

/**
 * The GitHub Workflow environment specifics.
 *
 * @see https://docs.github.com/en/actions/learn-github-actions/variables
 */
class GitHubWorkflow extends DefaultEnvironment
{

    /**
     * {@inheritdoc}
     */
    public const ENVIRONMENT_NAME = 'GITHUB_WORKFLOW';

    /**
     * {@inheritdoc}
     */
    public static function getEnvironment(): string
    {
        return static::CI;
    }
}
