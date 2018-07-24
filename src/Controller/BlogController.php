<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotNull;
use App\Form\ArticleType;
use App\Entity\Comment;
use App\Form\CommentType;

class BlogController extends Controller
{

    /**
     *
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        $Articles = $repo->findAll();
        
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $Articles
        ]);
    }

    /**
     *
     * @route("/", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     *
     * @Route("/blog/new/Com", name="comment_create")
     * @Route("/blog/{id}/edit/com", name="comment-edit")
     * @param Comment $comment
     * @param Request $request
     * @param ObjectManager $manager
     */
    public function formCom(Article $article = null, Comment $comment = null, Request $request, ObjectManager $manager)
    {
        if (! $comment) {
            $comment = new Comment();
        }
        
        $formCom = $this->createForm(CommentType::class, $comment);
        
        /*
         * $form->handleRequest($request);
         * if($form->isSubmitted() && $form->isValid()){
         * if (!$comment->getId()){
         * $comment->setCreatedAt(new \DateTime())
         * ;
         * }
         * //dump($article);
         * $manager->persist($comment);
         * $manager->flush();
         * return $this->redirectToRoute('blog_show',['id' => $comment->getId()]);
         * }
         */
        return $this->render('blog/modif-com.html.twig', [
            'formComment' => $formCom->createView(),
            'editcom' => $comment->getId() !== null
        ]);
    }

    /**
     *
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog-edit")
     */
    public function form(Article $article = null, Request $request, ObjectManager $manager)
    {
        if (! $article) {
            $article = new Article();
        }
        
        $form = $this->createForm(ArticleType::class, $article);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (! $article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }
            // dump($article);
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('blog_show', [
                'id' => $article->getId()
            ]);
        }
        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     *
     * @Route("/blog/{id}", name="blog_show")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig', [
            'article' => $article
        
        ]);
    }
}
