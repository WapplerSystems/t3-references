<?php

declare(strict_types=1);

namespace wapplersystems\References\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Domain\Repository\TagRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use wapplersystems\References\Domain\Model\Reference;
use wapplersystems\References\Domain\Repository\ReferenceRepository;

class ReferenceController extends ActionController
{

    public function __construct(readonly ReferenceRepository $referenceRepository, readonly TagRepository $tagRepository)
    {
    }

    public function listAction(): ResponseInterface
    {
        $references = $this->referenceRepository->findAll();

        if ($this->settings['technologyTagsPageId'] ?? false) {
            $this->view->assign('technologyTags', $this->tagRepository->findByPid($this->settings['technologyTagsPageId']));
        }

        $this->view->assign('references', $references);

        return $this->htmlResponse();
    }

    public function showAction(Reference $reference): ResponseInterface
    {
        $this->view->assign('reference', $reference);
        return $this->htmlResponse();
    }
}