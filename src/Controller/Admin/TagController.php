<?php

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\TagRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_ADMIN_TAG")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/admin/tags", name="app_admin_tags")
     */
    public function index(Request $request, TagRepository $tagRepository, PaginatorInterface $paginator)
    {
        $request->query->set('onPage', $request->query->get('onPage') ?? 20);
        $pagination = $paginator->paginate(
            $tagRepository->findAllWithSearchQuery($request->query->get('q'), $request->query->has('showDeleted')),
            $request->query->getInt('page', 1),
            (int) $request->query->get('onPage')
        );

        return $this->render('admin/tag/index.html.twig', compact('pagination'));
    }
}
