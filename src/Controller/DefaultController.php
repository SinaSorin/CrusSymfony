<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\Address;
use App\Entity\Author;
use App\Entity\File;
use App\Entity\Pdf;
use App\Services\GiftsService;
use App\Services\MyService;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DefaultController extends AbstractController
{
    public function __construct($logger){
        
    }


    /**
     * @Route("/", name="default")
     */
    public function index(GiftsService $gifts, Request $request, SessionInterface $session): Response
    {
        
        

        $users= $this->getDoctrine()->getRepository(User::class)->findAll();
 
        if(!$users)
        {
            throw $this->createNotFoundException('The users do not exist');
        }
        // exit($request->query->get('page','default'));
        // exit($request->server->get('HTTP_HOST'));
        // $request->isXmlHttpRequest();
        // $request->request->get('page');
        // $request->files->get('foo');

        return $this->render('default/index.html.twig',['controller_name' => 'DefaultController',
        'users' => $users,
        'random_gift' => $gifts->gifts,
    ]);
    }

    /**
     * @Route("/page", name="default20")
     */
    public function index20()
    {
        


        return $this->render('default/index.html.twig',['controller_name' => 'DefaultController',
        
    ]);
    }

    /**
     * @Route("/home/", name="home")
     */

    public function home(Request $request){

        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->find(1);
        $user->setName('Rob');
        $entityManager->persist($user);
        $entityManager->flush();


        return $this->render('default/index.html.twig',['controller_name' => 'DefaultController',
    ]);
    
    }

    public function mostPopularPosts($number = 3){
        //database call:
        $posts = ['post 1', 'post 2', 'post 3', 'post 4', ];
        return $this->render('default/most_popular_posts.html.twig',[
            'posts' => $posts,
        ]);
    }




    /**
     *  @Route("/generate-url/{param?}", name="generate_url" )
     * 
     */
    public function generate_url(){
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }
    /**
     *  @Route("/download")
     * 
     */
    public function download(){
        $path = $this->getParameter('download_directory');
        return $this->file($path.'file.pdf');
    }
    /**
     *  @Route("/redirect-test")
     * 
     */
    public function redirectTest(){
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));
    }
    /**
     *  @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     * 
     */
    public function methodToRedirect(){
       exit('Test redirection');
    }
    /**
     *  @Route("/forwarding-to-controller")
     * 
     */
    public function forwardingToController(){
        $response = $this->forward(
            'App\Controller\DefaultController::methodToForwardTo',
            array('param' => '1')
        );
        return $response;
     }
    /**
     *  @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
     * 
     */
    public function methodToForwardTo($param){

        exit('Test controller forwarding - '.$param);
    }




















    /**
     * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     */
    public function index2(){
        return new Response('Optional parameters in url and requirements for parameters');
    }
    /**
     * @Route("/articles/{_locale?}/{year}/{slug}/{category}", name="blog_list", defaults={"category":"computers"},
     * requirements={
     *      "_locale": "en|fr",
     *      "category": "computers|rtv",
     *      "year": "\d+"
     * }
     * )
     */
    public function index3(){
        return new Response('An advanced route example');
    }
    /**
     * @Route({
     *  "nl": "/over-ons",
     *  "en": "/about-us"
     * }, name="about_us")
     */
    public function index4(){
        return new Response('Translated routes');
    }
}
