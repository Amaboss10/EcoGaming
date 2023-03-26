<?php
namespace App\Tests;

use App\Entity\Posts;
use App\Entity\Comments;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CommentsUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $comments = new Comments();
        $post = new Posts();
        $user = new User();

        $comments->setPostId($post->getId())
            ->setText('ceci est un commentaire')
            ->setUserId($user->getId());

        $this->assertTrue($comments->getPostId() === $post->getId() );
        $this->assertTrue($comments->getText() === 'ceci est un commentaire');
        $this->assertTrue($comments->getUser() === $user->getId());

    }

    public function testIsFalse()
    {
        $comments = new Comments();
        $post = new Posts();
        $user = new User();

        $comments->setUserId($user->getId())
                 ->setText('ceci est un texte')
                 ->setPostId($post->getId());

        $this->assertFalse($comments->getUser() === $user);
        $this->assertFalse($comments->getText() === 'false');
        $this->assertFalse($comments->getPostId() === 0);

    }

    public function TestIsEmpty ()
    {
        $comment = new Comments();

        $this->assertEmpty($comment->getPostId());
        $this->assertEmpty($comment->getText());
        $this->assertEmpty($comment->getUser());
    }


}