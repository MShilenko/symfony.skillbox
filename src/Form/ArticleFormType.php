<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Article;
use App\Repository\UserRepository;
use App\Homework\ArticleWordsFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleFormType extends AbstractType
{
    /** @var UserRepository $userRepository */
    protected $userRepository;

    /** @var ArticleWordsFilter $articleWordsFilter */
    protected $articleWordsFilter;

    public function __construct(UserRepository $userRepository, ArticleWordsFilter $articleWordsFilter)
    {
        $this->userRepository = $userRepository;
        $this->articleWordsFilter = $articleWordsFilter;
    }



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Название статьи',
                'help' => 'Не используйте в названии слово "собака"',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание статьи',
                'attr' => [
                    'rows' => 3,
                ]
            ])
            ->add('body', TextareaType::class, [
                'label' => 'Содержимое статьи',
                'attr' => [
                    'rows' => 10,
                ]
            ])
            ->add('publishedAt', null, [
                'label' => 'Дата публикации статьи',
                'widget' => 'single_text',
            ])
            ->add('keywords', TextType::class, [
                'label' => 'Ключевые слова статьи',
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choices' => $this->userRepository->findAllSortedByName(),
                'choice_label' => function (User $user) {
                    return sprintf('%s (id: %d)', $user->getFirstName(), $user->getId());
                },
                'label' => 'Автор статьи',
                'placeholder' => 'Выберите автора статьи',
            ]);

        $builder->get('body')
            ->addModelTransformer(new CallbackTransformer(
                function ($bodyFromDatabase) {
                    return $bodyFromDatabase;
                },
                function ($bodyFromInput) {
                    return $this->articleWordsFilter->filter($bodyFromInput, ['стакан', 'чел']);
                }
            ));

        $builder->get('description')
            ->addModelTransformer(new CallbackTransformer(
                function ($bodyFromDatabase) {
                    return $bodyFromDatabase;
                },
                function ($bodyFromInput) {
                    return $this->articleWordsFilter->filter($bodyFromInput, ['стакан', 'чел']);
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
