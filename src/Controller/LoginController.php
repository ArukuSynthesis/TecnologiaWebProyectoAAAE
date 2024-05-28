<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Repository\UsuariosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(Request $request, UsuariosRepository $usuariosRepository): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $usuario = $data['_username'];
            $contrasenia = $data['_password'];

            $user = $usuariosRepository->findOneBy(['usuario' => $usuario]);

            if ($user && password_verify($contrasenia, $user->getContrasenia())) {
                return $this->redirectToRoute('app_avisos_index', [], Response::HTTP_SEE_OTHER);
            } else {
                return $this->render('login/login.html.twig', [
                    'error_message' => 'Usuario y/o contraseña incorrectos',
                    'form' => $form->createView(),
                ]);
            }
        }

        return $this->render('login/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
