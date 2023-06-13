<?php

class BlogPost
{
    public $title;

    public $body;

    public $tags = [];

    public $categories = [];

    // аргументов больше трех,не все из них могут потребоваться при создании экзепляра класса, можно преобразовать в Builder
//    public function __construct(string $title, string $body, array $categories = [], array $tags = [])
//    {
//        $this->title = $title;
//        $this->body = $body;
//        $this->categories = $categories;
//        $this->tags = $tags;
//    }

}

// new BlogPost('title', '', [], ['animal', 'cat']); // не удобно

interface BlogPostBuilderInterface
{
    public function create(): BlogPostBuilderInterface;

    public function setTitle(string $val): BlogPostBuilderInterface;

    public function setBody(string $val): BlogPostBuilderInterface;

    public function setCategories(array $val): BlogPostBuilderInterface;

    public function setTags(array $val): BlogPostBuilderInterface;

    public function getBlogPost(): BlogPost;
}

class BlogPostBuilder implements BlogPostBuilderInterface
{
    /** @var BlogPost */
    private  $blogPost;

    public function __construct()
    {
        $this->create();
    }

    public function create(): BlogPostBuilderInterface
    {
        $this->blogPost = new BlogPost();

        return $this;
    }

    public function setBody(string $val): BlogPostBuilderInterface
    {
        $this->blogPost->body = $val;

        return $this;
    }

    public function setCategories(array $val): BlogPostBuilderInterface
    {
        $this->blogPost->categories = $val;

        return $this;
    }

    public function setTags(array $val): BlogPostBuilderInterface
    {
        $this->blogPost->tags = $val;

        return $this;
    }

    public function getBlogPost(): BlogPost
    {
        $result = $this->blogPost;
        $this->create();

        return $result;
    }

    public function setTitle(string $val): BlogPostBuilderInterface
    {
        $this->blogPost->title = $val;

        return $this;
    }
}

/**
 * Содержит сценарии создания обьектов
 */
class BlogPostManager
{
    /** @var BlogPostBuilderInterface */
    private $builder;

    public function setBuilder(BlogPostBuilderInterface $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    public function createCleanPost()
    {
        $blogPost = $this->builder->getBlogPost();

        return $blogPost;
    }

    public function createNewPostIT()
    {
        $blogPost = $this->builder
            ->setTitle('Новый пост про IT')
            ->setBody('Новый пост про IT ...')
            ->setCategories([
                'категория_it'
            ])
            ->setTags([
                'tag_it',
                'tag_programming'
            ])
            ->getBlogPost();

        return $blogPost;
    }

    public function createNewPostCats()
    {
        $blogPost = $this->builder
            ->setTitle('Новый пост про кошек')
            ->setCategories([
                'категория кошки',
                'категория_питомцы'
            ])
            ->setTags([
                'tag_cats',
                'tag_pats0'
            ])
            ->getBlogPost();

        return $blogPost;
    }
}

$builder = new BlogPostBuilder();
$posts[] = $builder->setTitle('from Builder')
                    ->getBlogPost();

$manager = new BlogPostManager();
$manager->setBuilder($builder);
$posts[] = $manager->createCleanPost();
$posts[] = $manager->createNewPostIT();
$posts[] = $manager->createNewPostCats();

print_r($posts);