<?php

declare(strict_types=1);

namespace wapplersystems\References\Domain\Model;

use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
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
    protected ?FileReference $screenshotSmartphone = null;

    #[Cascade('remove')]
    protected ?FileReference $screenshotTablet = null;

    #[Cascade('remove')]
    protected ?FileReference $screenshotLaptop = null;

    #[Cascade('remove')]
    protected ?FileReference $screenshotDesktop = null;

    #[Cascade('remove')]
    protected ?FileReference $video = null;

    /**
     * @var ObjectStorage<Category>
     */
    protected ObjectStorage $categories;

    protected int $country = 0;

    protected string $duration = '';

    protected bool $greenHosting = false;

    public function __construct()
    {
        $this->categories = new ObjectStorage();
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
        return $this->screenshotSmartphone;
    }

    public function setScreenshotSmartphone(FileReference $screenshotSmartphone): void
    {
        $this->screenshotSmartphone = $screenshotSmartphone;
    }

    public function getScreenshotTablet(): ?FileReference
    {
        return $this->screenshotTablet;
    }

    public function setScreenshotTablet(FileReference $screenshotTablet): void
    {
        $this->screenshotTablet = $screenshotTablet;
    }

    public function getScreenshotLaptop(): ?FileReference
    {
        return $this->screenshotLaptop;
    }

    public function setScreenshotLaptop(FileReference $screenshotLaptop): void
    {
        $this->screenshotLaptop = $screenshotLaptop;
    }

    public function getScreenshotDesktop(): ?FileReference
    {
        return $this->screenshotDesktop;
    }

    public function setScreenshotDesktop(FileReference $screenshotDesktop): void
    {
        $this->screenshotDesktop = $screenshotDesktop;
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
        return $this->greenHosting;
    }

    public function setGreenHosting(bool $greenHosting): void
    {
        $this->greenHosting = $greenHosting;
    }

    public function isGreenHosting(): bool
    {
        return $this->greenHosting;
    }

    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    public function setCategories(ObjectStorage $categories): void
    {
        $this->categories = $categories;
    }
}
