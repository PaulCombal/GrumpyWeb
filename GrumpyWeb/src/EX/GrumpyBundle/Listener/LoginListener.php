<?php 

namespace EX\GrumpyBundle\Listener; 
use FOS\UserBundle\FOSUserEvents; 
use FOS\UserBundle\Event\UserEvent; 
use FOS\UserBundle\Model\UserManagerInterface; 
use Symfony\Component\EventDispatcher\EventSubscriberInterface; 
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent; 
use Symfony\Component\Security\Http\SecurityEvents; 

class LoginListener implements EventSubscriberInterface { 
    
    protected $userManager; 

    public function __construct(UserManagerInterface $userManager) 
    { 
       $this->userManager = $userManager;
    }
     
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
        );
    }
 
    protected function updateUser($user) {
        //Cette methode sera utilisé quand un utilisateur se connecte
    }
     
    public function onImplicitLogin(UserEvent $event)
    {
        $this->updateUser($event->getUser());
    }
     
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        $user = $event->getAuthenticationToken()->getUser();
        //if ($user instanceof UserInterface)
            $this->updateUser($user);
    }
}