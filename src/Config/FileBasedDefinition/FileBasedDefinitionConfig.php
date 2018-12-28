<?php
declare(strict_types=1);

namespace WoohooLabs\Zen\Config\FileBasedDefinition;

use function trim;

final class FileBasedDefinitionConfig implements FileBasedDefinitionConfigInterface
{
    /**
     * @var bool
     */
    private $isGlobalFileBasedDefinitionsEnabled;

    /**
     * @var string
     */
    private $relativeDirectory;

    /**
     * @var array
     */
    private $excludedClasses;

    public static function disabledGlobally(string $relativeDirectory = ""): FileBasedDefinitionConfig
    {
        return new FileBasedDefinitionConfig(false, $relativeDirectory);
    }

    public static function enabledGlobally(string $relativeDirectory): FileBasedDefinitionConfig
    {
        return new FileBasedDefinitionConfig(true, $relativeDirectory);
    }

    public static function create(bool $isGlobalAutoloadEnabled, string $relativeDirectory = ""): FileBasedDefinitionConfig
    {
        return new FileBasedDefinitionConfig($isGlobalAutoloadEnabled, $relativeDirectory);
    }

    public function __construct(bool $isGlobalAutoloadEnabled, string $relativeDirectory = "")
    {
        $this->isGlobalFileBasedDefinitionsEnabled = $isGlobalAutoloadEnabled;
        $this->excludedClasses = [];
        $this->setRelativeDirectory($relativeDirectory);
    }

    public function setRelativeDirectory(string $relativeDirectory): FileBasedDefinitionConfig
    {
        $this->relativeDirectory = trim($relativeDirectory, "\\/");

        return $this;
    }

    /**
     * @param string[] $excludedClasses
     */
    public function setExcludedClasses(array $excludedClasses): FileBasedDefinitionConfig
    {
        $this->excludedClasses = $excludedClasses;

        return $this;
    }

    public function isGlobalFileBasedDefinitionEnabled(): bool
    {
        return $this->isGlobalFileBasedDefinitionsEnabled;
    }

    public function getRelativeDirectory(): string
    {
        return $this->relativeDirectory;
    }

    public function getExcludedClasses(): array
    {
        return $this->excludedClasses;
    }
}
