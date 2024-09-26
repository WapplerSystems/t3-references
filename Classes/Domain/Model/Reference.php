<?php

declare(strict_types=1);

namespace wapplersystems\References\Domain\Model;


use TYPO3\CMS\Extbase\Domain\Model\Tag;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This file is part of the "Referenzen" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 WapplerSystems
 */

/**
 * Reference
 */
class Reference extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name;

    /**
     * slug
     *
     * @var string
     */
    protected $slug;

    /**
     * teaser
     *
     * @var string
     */
    protected $teaser;

    /**
     * description
     *
     * @var string
     */
    protected $description;

    /**
     * link
     *
     * @var string
     */
    protected $link;

    /**
     * logo
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $logo;

    /**
     * screenshot_smartphone
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $screenshot_smartphone;

    /**
     * screenshot_tablet
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $screenshot_tablet;

    /**
     * screenshot_laptop
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $screenshot_laptop;

    /**
     * screenshot_desktop
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $screenshot_desktop;

    /**
     * video
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $video;

    /**
     * technology
     *
     * @var ObjectStorage<Tag>
     */
    protected $technology;

    /**
     * industry
     *
     * @var ObjectStorage<Tag>
     */
    protected $industry;

    /**
     * target_group
     *
     * @var ObjectStorage<Tag>
     */
    protected $targetGroup;

    /**
     * country
     *
     * @var int
     */
    protected $country;

    /**
     * duration
     *
     * @var string
     */
    protected $duration;

    /**
     * green_hosting
     *
     * @var bool
     */
    protected $green_hosting;





    /**
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the slug
     *
     * @param string $slug
     * @return void
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Returns the teaser
     *
     * @return string
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * Sets the teaser
     *
     * @param string $teaser
     * @return void
     */
    public function setTeaser(string $teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Returns the link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the link
     *
     * @param string $link
     * @return void
     */
    public function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * Returns the logo
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Sets the logo
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo
     * @return void
     */
    public function setLogo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $logo)
    {
        $this->logo = $logo;
    }

    /**
     * Returns the screenshot_smartphone
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getScreenshot_smartphone()
    {
        return $this->screenshot_smartphone;
    }

    /**
     * Sets the screenshot_smartphone
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshot_smartphone
     * @return void
     */
    public function setScreenshot_smartphone(\TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshot_smartphone)
    {
        $this->screenshot_smartphone = $screenshot_smartphone;
    }

    /**
     * Returns the screenshot_tablet
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getScreenshot_tablet()
    {
        return $this->screenshot_tablet;
    }

    /**
     * Sets the screenshot_tablet
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshot_tablet
     * @return void
     */
    public function setScreenshot_tablet(\TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshot_tablet)
    {
        $this->screenshot_tablet = $screenshot_tablet;
    }

    /**
     * Returns the screenshot_laptop
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getScreenshot_laptop()
    {
        return $this->screenshot_laptop;
    }

    /**
     * Sets the screenshot_laptop
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshot_laptop
     * @return void
     */
    public function setScreenshot_laptop(\TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshot_laptop)
    {
        $this->screenshot_laptop = $screenshot_laptop;
    }

    /**
     * Returns the screenshot_desktop
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getScreenshot_desktop()
    {
        return $this->screenshot_desktop;
    }

    /**
     * Sets the screenshot_desktop
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshot_desktop
     * @return void
     */
    public function setScreenshot_desktop(\TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshot_desktop)
    {
        $this->screenshot_desktop = $screenshot_desktop;
    }

    /**
     * Returns the video
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Sets the video
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $video
     * @return void
     */
    public function setVideo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $video)
    {
        $this->video = $video;
    }



    /**
     * Returns the country
     *
     * @return int
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country
     *
     * @param int $country
     * @return void
     */
    public function setCountry(int $country)
    {
        $this->country = $country;
    }

    /**
     * Returns the duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the duration
     *
     * @param string $duration
     * @return void
     */
    public function setDuration(string $duration)
    {
        $this->duration = $duration;
    }

    /**
     * Returns the green_hosting
     *
     * @return bool
     */
    public function getGreen_hosting()
    {
        return $this->green_hosting;
    }

    /**
     * Sets the green_hosting
     *
     * @param bool $green_hosting
     * @return void
     */
    public function setGreen_hosting(bool $green_hosting)
    {
        $this->green_hosting = $green_hosting;
    }

    /**
     * Returns the boolean state of green_hosting
     *
     * @return bool
     */
    public function isGreen_hosting()
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
