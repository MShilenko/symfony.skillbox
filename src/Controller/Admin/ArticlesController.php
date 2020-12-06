<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/admin/articles/create", name="app_admin_articles_create")
     */
    public function create(): Response
    {
        $article = new Article();
        $article
            ->setTitle('Что делать, если надо верстать?')
            ->setSlug('what-do-' . rand(100, 999))
            ->setBody(<<<EOF
            Lorem ipsum **[кофе](/)** dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt Фронтенд Абсолютович ut labore et dolore magna aliqua. Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue quisque egestas diam. кофе blandit turpis cursus in hac habitasse platea dictumst quisque.

            Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae. A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod nisi porta lorem mollis aliquam ut porttitor leo.

            Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo sed egestas egestas. Egestas dui id ornare arcu odio ut.
            EOF);

        if (rand(1, 10) > 4) {
            $article->setPublishedAt(new DateTime(sprintf('-%sd days', rand(0, 50))));
        }

        return new Response('Страница создания статьи');
    }
}
