<?php

declare(strict_types=1);

namespace wapplersystems\References\Domain\Model;


use TYPO3\CMS\Extbase\Domain\Model\Category;
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
     * screenshotSmartphone
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $screenshotSmartphone;

    /**
     * screenshotTablet
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $screenshotTablet;

    /**
     * screenshotLaptop
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $screenshotLaptop;

    /**
     * screenshotDesktop
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $screenshotDesktop;

    /**
     * video
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $video;

    /**
     * categories
     *
     * @var ObjectStorage<Category>
     */
    protected $categories;

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
     * greenHosting
     *
     * @var bool
     */
    protected $greenHosting;

    public function __construct()
    {
        $this->categories = new ObjectStorage();
    }


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
     * Returns the screenshotSmartphone
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getScreenshotSmartphone()
    {
        return $this->screenshotSmartphone;
    }

    /**
     * Sets the screenshotSmartphone
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshotSmartphone
     * @return void
     */
    public function setScreenshotSmartphone(\TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshotSmartphone)
    {
        $this->screenshotSmartphone = $screenshotSmartphone;
    }

    /**
     * Returns the screenshotTablet
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getScreenshotTablet()
    {
        return $this->screenshotTablet;
    }

    /**
     * Sets the screenshotTablet
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshotTablet
     * @return void
     */
    public function setScreenshotTablet(\TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshotTablet)
    {
        $this->screenshotTablet = $screenshotTablet;
    }

    /**
     * Returns the screenshotLaptop
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getScreenshotLaptop()
    {
        return $this->screenshotLaptop;
    }

    /**
     * Sets the screenshotLaptop
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshotLaptop
     * @return void
     */
    public function setScreenshotLaptop(\TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshotLaptop)
    {
        $this->screenshotLaptop = $screenshotLaptop;
    }

    /**
     * Returns the screenshotDesktop
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getScreenshotDesktop()
    {
        return $this->screenshotDesktop;
    }

    /**
     * Sets the screenshotDesktop
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshotDesktop
     * @return void
     */
    public function setScreenshotDesktop(\TYPO3\CMS\Extbase\Domain\Model\FileReference $screenshotDesktop)
    {
        $this->screenshotDesktop = $screenshotDesktop;
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
     * Returns the greenHosting
     *
     * @return bool
     */
    public function getGreenHosting()
    {
        return $this->greenHosting;
    }

    /**
     * Sets the greenHosting
     *
     * @param bool $greenHosting
     * @return void
     */
    public function setGreenHosting(bool $greenHosting)
    {
        $this->greenHosting = $greenHosting;
    }

    /**
     * Returns the boolean state of greenHosting
     *
     * @return bool
     */
    public function isGreenHosting()
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
