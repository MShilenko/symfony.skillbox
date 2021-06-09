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
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
        /** @var Article|null $article */
        $article = $options['data'] ?? null;

        $cannotEditAuthor = $article && $article->getId() && $article->isPublished();

        $imageConstrains = [
            new Image([
                'maxSize' => '2M',
                'minHeight' => '300',
                'minWidth' => '480',
                'allowPortrait' => false,
            ]),
        ];

        if (!$article || !$article->getImage()) {
            $imageConstrains[] = new NotNull([
                'message' => 'Не выбрано изображение статьи',
            ]);
        }

        $builder
            ->add('title')
            ->add('description', TextareaType::class, [
                'rows' => 3,
            ])
            ->add('body')
            ->add('keywords')
            ->add('author', EntityType::class, [
                'disabled' => $cannotEditAuthor,
                'class' => User::class,
                'choices' => $this->userRepository->findAllSortedByName(),
                'choice_label' => function (User $user) {
                    return sprintf('%s (id: %d)', $user->getFirstName(), $user->getId());
                },
                'invalid_message' => 'Автор не найден!',
            ])
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => $imageConstrains
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

        if ($options['enable_published_at']) {
            $builder->add('publishedAt', null, [
                'widget' => 'single_text',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'enable_published_at' => false,
        ]);
    }
}
