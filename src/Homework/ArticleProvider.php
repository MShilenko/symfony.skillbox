<?php

namespace App\Homework;

class ArticleProvider
{
    private $articles;

    public function __construct()
    {   
        $this->articles = [
            0 => [
                'title' => 'Что делать, если надо верстать?',
                'slug' => 'what-do',
                'createdAt' => 1289520000,
                'image' => 'images/article-2.jpeg',
                'content' => <<<EOF
                Lorem ipsum **[кофе](/)** dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt Фронтенд Абсолютович ut labore et dolore magna aliqua. Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue quisque egestas diam. кофе blandit turpis cursus in hac habitasse platea dictumst quisque.

                Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae. A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod nisi porta lorem mollis aliquam ut porttitor leo.

                Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo sed egestas egestas. Egestas dui id ornare arcu odio ut.
                EOF,
            ],
            1 => [
                'title' => 'Facebook ест твои данные',
                'slug' => 'facebook',
                'createdAt' => 1363910400,
                'image' => 'images/article-1.jpeg',
                'content' => <<<EOF
                Lorem ipsum **[кофе](/)** dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt Фронтенд Абсолютович ut labore et dolore magna aliqua. Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue quisque egestas diam. кофе blandit turpis cursus in hac habitasse platea dictumst quisque.

                Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae. A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod nisi porta lorem mollis aliquam ut porttitor leo.

                Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo sed egestas egestas. Egestas dui id ornare arcu odio ut.
                EOF,
            ],
            2 => [
                'title' => 'Когда пролил кофе на клавиатуру',
                'slug' => 'cofeeee',
                'createdAt' => 1515196800,
                'image' => 'images/article-3.jpg',
                'content' => <<<EOF
                Lorem ipsum **[кофе](/)** dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt Фронтенд Абсолютович ut labore et dolore magna aliqua. Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue quisque egestas diam. кофе blandit turpis cursus in hac habitasse platea dictumst quisque.

                Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae. A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod nisi porta lorem mollis aliquam ut porttitor leo.

                Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo sed egestas egestas. Egestas dui id ornare arcu odio ut.
                EOF,
            ],
            3 => [
                'title' => 'Что делать, если надо верстать?',
                'slug' => 'what-do2',
                'createdAt' => 1576108800,
                'image' => 'images/article-2.jpeg',
                'content' => <<<EOF
                Lorem ipsum **[кофе](/)** dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt Фронтенд Абсолютович ut labore et dolore magna aliqua. Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue quisque egestas diam. кофе blandit turpis cursus in hac habitasse platea dictumst quisque.

                Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae. A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod nisi porta lorem mollis aliquam ut porttitor leo.

                Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo sed egestas egestas. Egestas dui id ornare arcu odio ut.
                EOF,
            ],
            4 => [
                'title' => 'Когда пролил кофе на клавиатуру',
                'slug' => 'cofeeee2',
                'createdAt' => 1607175553,
                'image' => 'images/article-3.jpg',
                'content' => <<<EOF
                Lorem ipsum **[кофе](/)** dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt Фронтенд Абсолютович ut labore et dolore magna aliqua. Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue quisque egestas diam. кофе blandit turpis cursus in hac habitasse platea dictumst quisque.

                Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae. A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod nisi porta lorem mollis aliquam ut porttitor leo.

                Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo sed egestas egestas. Egestas dui id ornare arcu odio ut.
                EOF,
            ],
        ];
    }

    public function articles(): array
    {
        return $this->articles;
    }

    public function article(): array
    {
        $rand_key = array_rand($this->articles);
        
        return $this->articles[$rand_key];
    }
}