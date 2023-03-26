<?php
namespace App\Tests;

use App\Entity\Posts;
use App\Entity\Comments;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class PostsUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $posts = new Posts();
        $datetime = new DateTime();
        $user = new User();

        $posts->setName('name')
              ->setContent('contenu')
              ->setDatePublication($datetime)
              ->setDescription('tets begh');

        $this->assertTrue($posts->getName() === 'name');
        $this->assertTrue($posts->getContent() === 'contenu');
        $this->assertTrue($posts->getDatePublication() === $datetime);
        $this->assertTrue($posts->getDescription() === 'tets begh');

    }

    public function testIsFalse()
    {
        $posts = new Posts();
        $datetime = new DateTime();
        $user = new User();

        $posts->setName('name')
            ->setContent('contenu')
            ->setDatePublication($datetime)
            ->setDescription('tets begh');

        $this->assertFalse($posts->getName() === 'false');
        $this->assertFalse($posts->getContent() === 'false');
        $this->assertFalse($posts->getDatePublication() === new $datetime);
        $this->assertFalse($posts->getDescription() === 'false');

    }

    public function TestIsEmpty ()
    {
        $posts = new Posts();

        $this->assertEmpty($posts->getName());
        $this->assertEmpty($posts->getId());
        $this->assertEmpty($posts->getDescription());
        $this->assertEmpty($posts->getId());
    }

    public function testAddGetRemoveComment()
    {
        $post = new Posts();
        $comment = new Comments();

        $this->assertEmpty($post->getComments());

        $post->addCommentPost($comment);
        $this->assertContains($comment, $post->getComments());

        $post->removeCommentPost($comment);
        $this->assertEmpty($post->getComments());

    }

}