<?php
namespace App\Tests;

use App\Entity\Posts;
use App\Entity\Comments;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $comments = new Comments();
        $post = new Posts();
        $user = new User();

        $user->setName('toto')
             ->setEmail('test@gmail.com')
             ->setFirstname('Jean')
             ->setPassword('root')
             ->setRoles(['Role_User']);

        $this->assertTrue($user->getName() === 'toto' );
        $this->assertTrue($user->getEmail() === 'test@gmail.com' );
        $this->assertTrue($user->getFirstname() === 'Jean' );
        $this->assertTrue($user->getPassword() === 'root' );
    }

    public function testIsFalse()
    {
        $user = new User();

        $user->setName('toto')
            ->setEmail('test@gmail.com')
            ->setFirstname('Jean')
            ->setPassword('root')
            ->setRoles([ 'Role_User']);

        $this->assertFalse($user->getName() === 'false');
        $this->assertFalse($user->getEmail() === 'false');
        $this->assertFalse($user->getFirstname() ===  'false');
        $this->assertFalse($user->getPassword() ===  'false');
        $this->assertFalse($user->getRoles() ==  [ 'role_User']);

    }

    public function TestIsEmpty ()
    {
        $user = new User();

        $this->assertEmpty($user->getName());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getRoles());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getId());
    }

    public function testAddGetRemoveUser()
    {
        $user = new User();
        $post = new Posts();
        $comment = new Comments();

        $this->assertEmpty($user->getUserComment());

        $user->addUserComment($comment);
        $this->assertContains($comment, $user->getUserComment());


        $user->addUserPost($post);
        $this->assertContains($post, $user->getUserPost());



    }


}