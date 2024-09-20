<?php

declare(strict_types=1);

namespace wapplersystems\References\Controller;


use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use wapplersystems\References\Domain\Repository\ReferenceRepository;

/**
 * This file is part of the "Referenzen" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 WapplerSystems
 */

/**
 * ReferenceController
 */
class ReferenceController extends ActionController
{

    public function __construct(readonly ReferenceRepository $referenceRepository)
    {
    }


    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $references = $this->referenceRepository->findAll();
        $this->view->assign('references', $references);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \wapplersystems\References\Domain\Model\Reference $reference
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\wapplersystems\References\Domain\Model\Reference $reference): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('reference', $reference);
        return $this->htmlResponse();
    }
}
