<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
class ArticleFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        // creer 3 catégorie faker
        for ($i = 1; $i <= 3; $i ++) {
            $category = new Category();
            $category->setTitle($faker->sentence())
                ->getDescription($faker->paragraph());
            
            $manager->persist($category);
            
            // creer entre 4 et 6 articles
            for ($j = 1; $j <= mt_rand(4, 6); $j ++) {
                $article = new Article();
                
                $content = '<p>' . join($faker->paragraphs(5), '</p><p>')
                . '</p>';
                $article->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->datetimeBetween('-6 months'))
                    ->setCategory($category);
                $manager->persist($article);
                
                for ($k = 1; $k <= mt_rand(4, 10); $k ++) {
                    $comment = new Comment();
                    
                    $content = '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';
                    $now = new \DateTime();
                    $interval=$now->diff($article->getCreatedAt());
                    $days=$interval->days;
                    $minimum = '-' . $days . 'days'; // -100 days
                    
                    $comment ->setAuthor($faker->name)
                 ->setContent($content)
                 ->setCreatedAt($faker->datetimeBetween($minimum))
                    ->setArticle($article);
                    
                    $manager->persist($comment);
                    
                
                }
            
        }
        
        }

        $manager->flush();
    }
}
