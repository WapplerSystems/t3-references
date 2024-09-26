<?php

declare(strict_types=1);

namespace wapplersystems\References\Controller;


use TYPO3\CMS\Extbase\Domain\Repository\TagRepository;
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

    public function __construct(readonly ReferenceRepository $referenceRepository, readonly TagRepository $tagRepository)
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

        //ToDo jeweiligen Tags holen

        if ($this->settings['technologyTagsPageId'] ?? false) {
            $this->view->assign('technologyTags', $this->tagRepository->findByPid($this->settings['technologyTagsPageId']));
        }


        $this->view->assignMultiple([
            'references' => $references,
            'xyz' => 'kurtgkugtrkuhg',
        ]);

        return $this->htmlResponse();


    }
    /**
     * Renders the search form with the dropdown
     */
   /** public function searchFormAction()
    {
        // Hole alle Referenzen aus der Datenbank
        $references = $this->referenceRepository->findAll();

        // Übergib die Daten an das Template
        $this->view->assign('references', $references);
    }*/
    /**
     * Perform search based on the selected reference
     */
   /** public function searchResultAction($reference)
    {
        // Finde die gewählte Referenz und gebe sie an das Template weiter
        $selectedReference = $this->referenceRepository->findByUid($reference);
        $this->view->assign('reference', $references);
    }*/
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
