<?php

/**
 * Example: Real World
 * 
 * Post content to Social Network (Facebook, LinkedIn, ...)
 */

interface SocialNetworkConnector
{
    public function login(): void;
    public function logout(): void;
    public function createPost(string $content): void;
}

class FacebookConnector implements SocialNetworkConnector
{
    public function __construct(
        private string $loginId,
        private string $password
    ) {}

    public function login(): void
    {
        // Login with Facebook in here...
        echo "You logged in Facebook with user: ".$this->loginId." ,password: ".$this->password."\n";
    }

    public function logout(): void
    {
        // Logout with Facbook in here...
        echo "You logged out Facebook user: ".$this->loginId."\n";
    }

    public function createPost(string $content): void
    {
        echo "You poted a content to Facebook: ".$content."\n";
    }
}

class LinkedInConnector implements SocialNetworkConnector
{
    public function __construct(
        private string $email,
        private string $password
    ) {}

    public function login(): void
    {
        echo "You logged in LinkedIn with user: ".$this->email." ,password: ".$this->password.".\n";
    }

    public function logout(): void
    {
        echo "You logged out LinkedIn with user: ".$this->email."\n";
    }

    public function createPost(string $content): void
    {
        echo "You posted a content to LinkedIn: ".$content."\n";
    }
}

abstract class SocialNetworkPoster
{
    abstract public function getSocialNetwork(): SocialNetworkConnector;

    public function post(string $content): void
    {
        $network = $this->getSocialNetwork();

        $network->login();
        $network->createPost($content);
        $network->logout();
    }
}

class FacebookPoster extends SocialNetworkPoster
{
    public function __construct(
        private string $loginId,
        private string $password
    ) {}

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new FacebookConnector($this->loginId, $this->password);
    }
}

class LinkedInPoster extends SocialNetworkPoster
{
    public function __construct(
        private string $email,
        private string $password
    ) {}

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new LinkedInConnector($this->email, $this->password);
    }
}

/**
 * Client code có thể làm việc với bất kì 1 SocialNetworkPoster nào (FacebookPoster, LinkedInPoster, ...)
 * và nó ko quan tâm FacebookConnector và LinkedInConnector thực hiện như nào, 2 products này tách biệt hoàn
 * toàn với nó (Client code), khi 2 products này thay đổi thì "Client code" cũng ko bị ảnh hưởng về code.
 */
function clientCode(SocialNetworkPoster $creator)
{
    $creator->post("Hello 001");
    $creator->post("Hello 002");
}


/* Khi ở giai đoạn khởi tạo ứng dụng thì ứng dụng sẽ chọn 1 trong 2 poster sau: */

// Facebook post
echo "============= Start with FB:\n";
clientCode(new FacebookPoster("kevinduy", "fbpass******"));

echo "\n\n";

// LinkedIn post
echo "============= Start with LinkedIn:\n";
clientCode(new LinkedInPoster("mr.kevinduy@gmail.com", "linkedpass******"));