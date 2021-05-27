<?php

namespace App\Controller\Admin;

use App\Repository\CommentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends AbstractController
{
    /**
     * @Route("/admin/comments", name="app_admin_comments")
     */
    public function index(Request $request, CommentRepository $commentRepository, PaginatorInterface $paginator)
    {    
        $request->query->set('onPage', $request->query->get('onPage') ?? 20);
        $pagination = $paginator->paginate(
            $commentRepository->findAllWithSearchQuery($request->query->get('q'), $request->query->has('showDeleted')), 
            $request->query->getInt('page', 1),
            (int) $request->query->get('onPage')
        );

        return $this->render('admin/comments/index.html.twig', compact('pagination'));
    }
}
