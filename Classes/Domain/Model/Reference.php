<?php

declare(strict_types=1);

namespace wapplersystems\References\Domain\Model;

use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Domain\Model\Tag;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Reference extends AbstractEntity
{

    #[Validate('NotEmpty')]
    protected string $name = '';

    protected string $slug = '';

    protected string $teaser = '';

    protected string $description = '';

    protected string $link = '';

    #[Cascade('remove')]
    protected ?FileReference $logo = null;

    #[Cascade('remove')]
    protected ?FileReference $screenshot_smartphone = null;

    #[Cascade('remove')]
    protected ?FileReference $screenshot_tablet = null;

    #[Cascade('remove')]
    protected ?FileReference $screenshot_laptop = null;

    #[Cascade('remove')]
    protected ?FileReference $screenshot_desktop = null;

    #[Cascade('remove')]
    protected ?FileReference $video = null;

    /**
     * @var ObjectStorage<Tag>
     */
    protected ObjectStorage $technology;

    /**
     * @var ObjectStorage<Tag>
     */
    protected ObjectStorage $industry;

    /**
     * @var ObjectStorage<Tag>|null
     */
    protected ?ObjectStorage $targetGroup = null;

    protected int $country = 0;

    protected string $duration = '';

    protected bool $green_hosting = false;

    public function __construct()
    {
        $this->technology = new ObjectStorage();
        $this->industry = new ObjectStorage();
        $this->targetGroup = new ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getTeaser(): string
    {
        return $this->teaser;
    }

    public function setTeaser(string $teaser): void
    {
        $this->teaser = $teaser;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getLogo(): ?FileReference
    {
        return $this->logo;
    }

    public function setLogo(FileReference $logo): void
    {
        $this->logo = $logo;
    }

    public function getScreenshotSmartphone(): ?FileReference
    {
        return $this->screenshot_smartphone;
    }

    public function setScreenshotSmartphone(FileReference $screenshot_smartphone): void
    {
        $this->screenshot_smartphone = $screenshot_smartphone;
    }

    public function getScreenshotTablet(): ?FileReference
    {
        return $this->screenshot_tablet;
    }

    public function setScreenshotTablet(FileReference $screenshot_tablet): void
    {
        $this->screenshot_tablet = $screenshot_tablet;
    }

    public function getScreenshotLaptop(): ?FileReference
    {
        return $this->screenshot_laptop;
    }

    public function setScreenshotLaptop(FileReference $screenshot_laptop): void
    {
        $this->screenshot_laptop = $screenshot_laptop;
    }

    public function getScreenshotDesktop(): ?FileReference
    {
        return $this->screenshot_desktop;
    }

    public function setScreenshotDesktop(FileReference $screenshot_desktop): void
    {
        $this->screenshot_desktop = $screenshot_desktop;
    }

    public function getVideo(): ?FileReference
    {
        return $this->video;
    }

    public function setVideo(FileReference $video): void
    {
        $this->video = $video;
    }

    public function getCountry(): int
    {
        return $this->country;
    }

    public function setCountry(int $country): void
    {
        $this->country = $country;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): void
    {
        $this->duration = $duration;
    }

    public function getGreenHosting(): bool
    {
        return $this->green_hosting;
    }

    public function setGreenHosting(bool $green_hosting): void
    {
        $this->green_hosting = $green_hosting;
    }

    public function isGreenHosting(): bool
    {
        return $this->green_hosting;
    }

    public function getTechnology(): ObjectStorage
    {
        return $this->technology;
    }

    public function setTechnology(ObjectStorage $technology): void
    {
        $this->technology = $technology;
    }

    public function getIndustry(): ObjectStorage
    {
        return $this->industry;
    }

    public function setIndustry(ObjectStorage $industry): void
    {
        $this->industry = $industry;
    }

    public function getTargetGroup(): ?ObjectStorage
    {
        return $this->targetGroup;
    }

    public function setTargetGroup(ObjectStorage $targetGroup): void
    {
        $this->targetGroup = $targetGroup;
    }
}