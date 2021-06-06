<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Article;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use App\Homework\ArticleWordsFilterInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleFormType extends AbstractType
{
    /** @var UserRepository $userRepository */
    protected $userRepository;

    /** @var ArticleWordsFilterInterface $articleWordsFilter */
    protected $articleWordsFilter;

    public function __construct(UserRepository $userRepository, ArticleWordsFilterInterface $articleWordsFilter)
    {
        $this->userRepository = $userRepository;
        $this->articleWordsFilter = $articleWordsFilter;
    }



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => 3,
                ]
            ])
            ->add('body', TextareaType::class, [
                'attr' => [
                    'rows' => 10,
                ]
            ])
            ->add('publishedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('keywords')
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choices' => $this->userRepository->findAllSortedByName(),
                'choice_label' => function (User $user) {
                    return sprintf('%s (id: %d)', $user->getFirstName(), $user->getId());
                },
                'invalid_message' => 'Автор не найден!',
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
